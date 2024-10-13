<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryAttribute;
use Illuminate\Http\Request;
use App\Models\attribute;
use App\Traits\ApiResponce;
use App\Traits\SaveFile;

use Validator;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoryController extends Controller
{
    use SaveFIle;
    use ApiResponce;
    
    public function index()
    {
        $data = Category::get();
        return view('admin/Category/category', get_defined_vars());
    }
    public function store(Request $request)
    {
        // print_r($request->id);die();
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'mimes:jpeg,png,jpg,gif|max:5120',
            // 'attribute_id'=>"required|exists:attributes,id",
            'id' => 'required',

        ]);

        // Handle validation failure
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
            // return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
            if ($request->id > 0) {
                $image = Category::find($request->id);
                $imageName = $image->image;
                $imageName = $this->saveImage($request->image, $imageName, 'images/categories/');
            } else {
                $imageName = $this->saveImage($request->image, '', 'images/categories/');
            }


            Category::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $imageName,
                    'parent_category_id' => $request->parent_category_id,
                ]

            );
            return $this->success(['reload' => true], 'successfully updated ');
        }
    }
    public function index_category_attribute()
    {
        $data = CategoryAttribute::with('category','attribute')->get();
        $category =Category::get();
        $attribute=Attribute::get();
        // prx($data->toArray());
        return view('admin/Category/category_attribute', get_defined_vars());
    }
    public function store_category_attribute(Request $request){
        $validation= Validator::make($request->all(),[
            'attribute_id'=>"required|exists:attributes,id",
            'category_id'=>"required|exists:categories,id",
            'id'=>'required',
        ]);
        if($validation->fails()){
            return $this->error($validation->errors()->first(),400,[]);
        }else{
            CategoryAttribute::updateOrCreate(
                ['id'=>$request->id],
                ['attribute_id' => $request->attribute_id,
                'category_id' => $request->category_id,
                ]
            );
            return $this->success(['reload'=>true],'successfully updated ');
        }
    }

}