<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'category_id',
        'attribute_value_id',
    ];
    // public function product(){
    //     return $this->hasOne(product::class,'id','product_id');
    // }
    // public function category(){
    //     return $this->hasOne(category::class,'id','category_id');
    // }
    public function attribute_values(){
        return $this->hasOne(attributeValue::class,'id' ,'attribute_value_id');
    }
   
    // public function values(){
    //     return $this->hasOne(attributeValue::class,'attributes_id','attribute_value_id');
    // }
    
}
