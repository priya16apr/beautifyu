<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeFaq extends Model
{
    use HasFactory;

    function producttype()
    {
        return $this->belongsTo(ProductType::class,'producttype_id');
    }
}
