<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\color;
use App\Traits\ApiResponce;
use Validator;

class ColorController extends Controller
{
    use ApiResponce;
    public function index(){
        $data= color::get();
        return view('admin/Color/color' ,get_defined_vars());
    }
    public function store(Request $request){
        $validation= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'id'=>'required',
        ]);
        if($validation->fails()){
            return $this->error($validation->errors()->first(),400,[]);
        }else{
            Color::updateOrCreate(
                ['id'=>$request->id],
                ['name'=>$request->name],
            );
            return $this->success(['reload'=>true],'successfully updated ');
        }

    }
}
