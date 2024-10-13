<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_attr extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'mrp',
        'sku',
        'price',
        'data',
        'qty',
     ];
     public function images(){
        return $this->hasMany(product_image::class,'product_attr_id','id');
    }
}
