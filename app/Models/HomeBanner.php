<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Illuminate\Database\Eloquent\Casts\Attribute;
use URL;

class HomeBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'link',
        'image',
        
        
    ];
    protected function Image():attribute{
        return Attribute::make(
            get:fn($value)=>URL::to(''.$value.'')
        );
    }
}
