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
        return $this->belongsTo(ProducttypeCollection::class);
    }

    function brand()
    {
        return $this->belongsTo(Brand::class);
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
        return $this->belongsTo(Producttype::class);
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
        return $this->hasMany(Rating::class);
    }

    function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
