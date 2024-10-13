<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\attribute;
use App\Models\attributeValue;
use Illuminate\Http\Request;
use App\Traits\ApiResponce;
use Validator;
class AttributeController extends Controller
{
    use ApiResponce;
    public function index_attribute_name(){
        $data= attribute::get();
        return view('admin/Attribute/attribute' ,get_defined_vars());
    }
       public function store_attribute_name(Request $request){
        $validation= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'slug'=>'required|string|max:255',
            'id'=>'required',
        ]);
        if($validation->fails()){
            return $this->error($validation->errors()->first(),400,[]);
        }else{
            attribute::updateOrCreate(
                ['id'=>$request->id],
                ['name'=>$request->name,
                'slug'=>$request->slug],
            );
            return $this->success(['reload'=>true],'successfully updated ');
        }

    }
    public function index_attribute_value(){
        $data= attributeValue::with('singleAttribute')->get();
        // echo"<pre>";print_r($data);die();
        $attribute =attribute::get();
        return view('admin/Attribute/attribute_value' ,get_defined_vars());
    }

    public function store_attribute_value(Request $request){
        $validation= Validator::make($request->all(),[
            'attributes_id'=>"required|exists:attributes,id",
            
            'value'=>'required|string|max:255',
            'id'=>'required',
        ]);
        if($validation->fails()){
            return $this->error($validation->errors()->first(),400,[]);
        }else{
            attributeValue::updateOrCreate(
                ['id'=>$request->id],
                ['value'=>$request->value,'attributes_id'=>$request->attributes_id],
            );
            return $this->success(['reload'=>true],'successfully updated ');
        }

    }
}
