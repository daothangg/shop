<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;
use App\Traits\ApiResponce;



class SizeController extends Controller
{
    use ApiResponce;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Size::get();
        return view('admin/Size/size',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // print_r($request->id);die();
    $validation = Validator::make($request->all(), [
        'text' => 'required|string|max:255',
        'id' => 'required',
        
    ]);

    // Handle validation failure
    if ($validation->fails()) {
        return $this->error($validation->errors()->first(),400,[]);
        // return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
    } else {
       
        Size::updateOrCreate(
            ['id' => $request->id],
            [
                'text' => $request->text,
              
            ]
        
        );
        return $this->success(['reload'=>true],'successfully updated ');
    }
}
}
