<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug',
        'image',
        'item_code',
        'keywords',
        'description',
        'category_id',
        'brand_id'
    ];
         public function attribute(){
             return $this->hasMany(product_attribute::class,'product_id' ,'id',);
         }
         public function productAttributes(){
             return $this->hasMany(product_attr::class,'product_id','id')->with('images');
         }
        //  public function category(){
        //     return $this->hasOne(category::class,'id','category_id');
        // }
        //  public function brand(){
        //     return $this->hasOne(brand::class,'id','brand_id');
        // }
          

}
