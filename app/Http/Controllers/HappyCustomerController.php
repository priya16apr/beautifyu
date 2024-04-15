<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

class HappyCustomerController extends Controller
{
    public function index()
    {
        return view('happycustomer.index');
    }

}
