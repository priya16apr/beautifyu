<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HappyCustomer;

class HappyCustomerController extends Controller
{
    public function index()
    {
        $setting        =  getAllSetting();
      
        $hcustomer      =  HappyCustomer::where('is_visible','Yes')->orderby('id','desc')->get();

        $info           =  compact('setting','hcustomer');
        
        return view('happycustomer.index')->with($info);
    }

}
