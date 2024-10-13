<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;
use App\Traits\ApiResponce;



class HomeBannerController extends Controller
{
    use ApiResponce;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HomeBanner::get();
        return view('admin/HomeBanner/home_banners',get_defined_vars());
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
        'link' => 'required|string|max:255',
        'image' => 'mimes:jpeg,png,jpg,gif|max:5120',
        'id' => 'required',
        
    ]);

    // Handle validation failure
    if ($validation->fails()) {
        return $this->error($validation->errors()->first(),400,[]);
        // return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
    } else {
        if($request->hasFile('image')){
            if($request->id>0){
                $image= HomeBanner::where('id',$request->id)->first();
                $image_path="image/".$image->image."";
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
            }
            $image_name='images/' . $request->name . time() . '.' . $request->image->extension();
            
            $request->image->move(public_path('images/'),$image_name);
        }elseif($request->id>0){
            $image_name=HomeBanner::where('id',$request->post('id'))->pluck('image')->first();
        }
        //lay img default
        // $image_name = $request->image ? $request->image : '448383722_332513999893525_3792276178432463082_n.jpg';
        HomeBanner::updateOrCreate(
            
            ['id' => $request->id],
            [
                'text' => $request->text,
                'link' => $request->link,
                'image' => $image_name  // If $image_name is empty, it will use the default image
            ]
        
        );
        prx($request->all());
        return $this->success(['reload'=>true],'successfully updated ');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
