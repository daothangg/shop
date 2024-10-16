<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use URL;
class brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
    ];
    protected function Image():attribute{
        return Attribute::make(
            get:fn($value)=>URL::to(''.$value.'')
        );
    }
}
