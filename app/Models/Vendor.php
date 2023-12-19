<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    function account()
    {
        return $this->hasOne(VendorAccount::class,'vendor_id');
    }

    function document()
    {
        return $this->hasOne(VendorDocument::class,'vendor_id');
    }

    function products()
    {
        return $this->hasMany(Product::class);
    }

    function orders()
    {
        return $this->hasMany(Order::class);
    }
}
