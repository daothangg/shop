<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Traits\ApiResponce;

class dashboardController extends Controller
{
    use ApiResponce;
    public function index(){
        return view('admin/index');
    }
    public function deleteData($id='',$table='')
    {
        DB::table(''.$table.'')->where('id',$id)->delete();
        return $this->success(['reload'=>true],'successfully delete ');
    }
}