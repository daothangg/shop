<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Http\Request;
use App\Traits\ApiResponce;
use App\Traits\SaveFile;

use Validator;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    use SaveFIle;
    use ApiResponce;
    public function index()
    {
        $data = brand::get();
        return view('admin/Brands/brands', get_defined_vars());
    }
    public function store(Request $request)
    {
        // print_r($request->id);die();
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255',
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
                $image = brand::find($request->id);
                $imageName = $image->image;
                $imageName = $this->saveImage($request->image, $imageName, 'images/categories/');
            } else {
                $imageName = $this->saveImage($request->image, '', 'images/categories/');
            }


            brand::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    // 'slug' => $request->slug,
                    'image' => $imageName,
                    'parent_category_id' => $request->parent_category_id,
                ]

            );
            return $this->success(['reload' => true], 'successfully updated ');
        }
    }


}
