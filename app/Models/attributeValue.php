<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'attributes_id',
    ];
    public function singleAttribute(){
        return $this->hasMany(attribute::class,'id','attributes_id');
    }
}
