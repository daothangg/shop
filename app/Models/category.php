<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryAttribute;
use Illuminate\Database\Eloquent\Casts\Attribute;
use URL;
class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_category_id'
        
        
    ];
    public function products(){
        return $this->hasMany(product::class,'category_id','id');
    }
    public function subcategories(){
        return $this->hasMany(category::class,'parent_category_id','id');
    }
    protected function Image():attribute{
        return Attribute::make(
            get:fn($value)=>URL::to(''.$value.'')
        );
    }
}
