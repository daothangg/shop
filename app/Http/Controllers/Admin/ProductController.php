<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\attribute;
use App\Models\attributeValue;
use App\Models\brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\product;
use App\Models\product_attr;
use App\Common\Helper;
use App\Models\product_attribute;
use App\Models\product_image;
use App\Models\color;
use App\Models\Size;
use DB;
use Illuminate\Http\Request;
use App\Traits\ApiResponce;
use App\Traits\SaveFIle;
use Redirect;
use Illuminate\Support\Facades\File;
use Validator;


class ProductController extends Controller
{
    use SaveFIle;
    use ApiResponce;
    // use Helper;
    public function index()
    {
        $data = product::get();
        // $brand = brand::get();
        // $category = Category::get();


        return View('admin/Product/product', get_defined_vars());

    }
    public function view_product($id = 0)
    {
        $color = color::get();
        $size = Size::get();
        $brand = brand::get();
        $category = Category::get();
        $attribute = new attribute();
        // $data = product::get();

        if ($id == 0) {
            $data = new product();
            $data['productAttributes'] = $this->attrDummyData();
            // prx($data);
            // $product_attr = new product_attr();
            $product_attr_images = new product_image();

        } else {
            $data['id'] = $id;
            $validation = Validator::make($data, [
                'id' => 'required|exists:products,id',
            ]);
            if ($validation->fails()) {
                return Redirect::black();
            } else {
                $data = product::where('id', $id)->with('attribute', 'productAttributes')->first();
                // prx($data);

            }


        }

        return view('admin/Product/manage_product', get_defined_vars());
        // prx(get_defined_vars());
    }
    public function attrDummyData()
    {
        $data[0]['id'] = 0;
        $data[0]['color_id'] = 0;
        $data[0]['size_id'] = 0;
        $data[0]['sku'] = 0;
        $data[0]['mrp'] = 0;
        $data[0]['price'] = 0;
        $data[0]['data'] = 0;
        $data[0]['qty'] = 0;
        return $data;
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // prx($request->all());
            // Validation rules
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                // 'attribute_id' => 'exists:attributes,id',
                'slug' => 'required|string|max:255',
                'image' => 'mimes:jpeg,png,jpg,gif|max:5120',
                'item_code' => 'required|string|max:255',
                'keywords' => 'required|string|max:255',
                'description' => 'required|string|max:5000',
                'category_id' => "required|exists:categories,id",
                'brand_id' => "required|exists:brands,id",


            ]);

            $cleanImageName = $this->clean($request->name);
            if ($validation->fails()) {
                return $this->error($validation->errors()->first(), 400, []);
            } else {

                // Handle the image upload
                $image_name = null;
                if ($request->hasFile('image')) {
                    if ($request->id > 0) {
                        $image = product::where('id', $request->id)->first();
                        $image_path = "image/products/" . $image->image;
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }

                    $image_name = "image/products/" . $cleanImageName . time() . '.' . $request->image->extension();
                    $request->image->move(public_path('image/products'), $image_name);
                } elseif ($request->id > 0) {
                    $image_name = product::where('id', $request->id)->pluck('image')->first();
                }
                // Create or update the product
                $productId = product::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name' => $request->name,
                        'slug' => $request->slug,
                        'item_code' => $request->item_code,
                        'keywords' => $request->keywords,
                        'description' => $request->description,
                        'image' => $image_name,
                        'category_id' => $request->category_id,
                        'brand_id' => $request->brand_id
                    ]
                );
                $productId = $productId->id;
                product_attribute::where('product_id', $productId)->delete();
                if ($request->attribute_id != '') {
                    foreach ($request->attribute_id as $key => $val) {
                        product_attribute::updateOrCreate(
                            [
                                'product_id' => $productId,
                                'attribute_value_id' => $val,
                                'category_id' => $request->category_id
                            ],
                            [
                                'product_id' => $productId,
                                'category_id' => $request->category_id,
                                'attribute_value_id' => $val
                            ]
                        );
                    }
                }
                // prx($request->all());
                $productAttrNewId = [];
                // Handle product SKU, colors, and sizes
                foreach ($request->sku as $key => $val) {
                    $productAttrId = product_attr::updateOrCreate(
                        ['id' => $request->productAttrId[$key]],
                        [
                            'product_id' => $productId,
                            'color_id' => $request->color_id[$key],
                            'size_id' => $request->size_id[$key],
                            'sku' => $request->sku[$key],
                            'mrp' => $request->mrp[$key],
                            'price' => $request->price[$key],
                            'data' => $request->data[$key],
                            'qty' => $request->qty[$key]
                        ]
                    );
                    $productAttrId = $productAttrId->id;
                    // array_push($productAttrNewId, $productAttrId);
                    $attrImage = [];
                    // prx($request->all());

                    $imageVal = 'attr_image_' . $request->imageValue[$key];
                    if ($request->$imageVal) {
                        foreach ($request->$imageVal as $key => $val) {
                            prx($request->$imageVal);
                            $image_name = "image/productsAttr/" . $this->getRandomValue() . $cleanImageName . time() . '.' . $val->extension();
                            $val->move(public_path('image/productsAttr/'), $image_name);
                            product_image::updateOrCreate([
                                'product_id' => $productId,
                                'product_attr_id' => $productAttrId,
                                'image' => $image_name
                            ]);

                        }

                    }


                }


                // prx($request->all());
                DB::commit();
                return redirect('admin/product')->with('success', 'Product successfully updated');
            }



        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error('Error updating product: ' . $th->getMessage());
            return $this->error($th->getMessage(), 500);
        }
    }

    public function clean($string)
    {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
    public function getAttributes(Request $request)
    {
        $category_id = $request->category_id;
        $data = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();
        return $this->success(['data' => $data], 'Successfully retrieved attributes.');

    }
    public function getRandomValue()
    {
        return bin2hex(random_bytes(5)); // tạo một chuỗi ngẫu nhiên 10 ký tự
    }
    public function removeAttrId(Request $request)
    {
        $type = $request->type;
        DB::table($request->type)->where('id', $request->id)->delete();
        return $this->success(['status' => 'success'], 'Successfully Updated');
    }
}
