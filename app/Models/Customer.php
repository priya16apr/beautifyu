<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    function addresss()
    {
        return $this->hasMany(Address::class);
    }

    function orders()
    {
        return $this->hasMany(Order::class);
    }

    function wishlists()
    {
        return $this->hasMany(Wishlist::class);
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
