<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducttypeFaq extends Model
{
    use HasFactory;

    function producttype()
    {
        return $this->belongsTo(Producttype::class);
    }
}
