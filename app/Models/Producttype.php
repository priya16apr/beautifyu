<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    // Belongs To
    function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    
    // Many
    function collections()
    {
        return $this->hasMany(ProductTypeCollection::class,'producttype_id');
    }

    function attributes()
    {
        return $this->hasMany(ProductTypeAttribute::class,'producttype_id');
    }

    function faqs()
    {
        return $this->hasMany(ProductTypeFaq::class,'producttype_id');
    }
}
