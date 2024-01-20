<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
    function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function orderaddress()
    {
        return $this->belongsTo(OrderAddress::class,'order_address_id');
    }

    function orderproducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
