<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    function order()
    {
        return $this->belongsTo(Order::class);
    }

    function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
