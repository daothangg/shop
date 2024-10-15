<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\HomeBanner;
use App\Models\product;
use App\Traits\ApiResponce;
use Illuminate\Http\Request;

class HomepageController extends Controller
{   
    use ApiResponce;
    public function getHomeData(){
        $data=[];
        $data['banner']=HomeBanner::get();
        $data['categories']=category::with('products:id,category_id,name,slug,image,item_code')->get();
        $data['brand']=brand::get();
        $data['products']=product::with('productAttributes')->select('id','category_id','image','name','slug','item_code')->get();
        return $this->success(['data'=>$data],'successfully data ');
    }
    public function getcategoriesData(){
        $data=[];
        $data['categories']=category::with('subcategories')->where('parent_category_id',null)->get();
        return $this->success(['data'=>$data],'successfully data ');
    }
}
