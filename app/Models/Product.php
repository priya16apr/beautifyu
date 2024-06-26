<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    function collection()
    {
        return $this->belongsTo(ProductTypeCollection::class);
    }

    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    function color()
    {
        return $this->belongsTo(Color::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    function producttype()
    {
        return $this->belongsTo(ProductType::class);
    }

    function variant()
    {
        return $this->hasOne(ProductVariant::class);
    }
    
    function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

}
