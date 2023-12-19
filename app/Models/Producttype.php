<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producttype extends Model
{
    use HasFactory;

    function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    function attributes()
    {
        return $this->hasMany(ProducttypeAttribute::class);
    }

    function faqs()
    {
        return $this->hasMany(ProducttypeFaq::class,'producttype_id');
    }
}
