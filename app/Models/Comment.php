<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
