<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\HomeuiBanner;
use App\Models\HomeuiUsp;
use App\Models\Product;
use App\Models\HappyCustomer;

class HomeController extends Controller
{
    public function index()
    {
        $topbanner      =  HomeuiBanner::where('type','Top Banner')->get();
        $usp            =  HomeuiUsp::get();
        
        $p_arrival      =  Product::where('status','4')->orderby('id','desc')->paginate('12');
        $p_trending     =  Product::where('status','4')->orderby('id','desc')->paginate('12');
        $p_celeb        =  Product::where('status','4')->where('is_celeb','Yes')->paginate('4');
        $p_combo        =  Product::where('status','4')->where('producttype_id','7')->paginate('4');
        $p_deal         =  Product::where('status','4')->paginate('4');
       
        $hcustomer      =  HappyCustomer::where('is_visible','Yes')->orderby('id','desc')->get();
        
        $info           =  compact('topbanner','usp','p_arrival','p_trending','p_celeb','p_combo','p_deal','hcustomer');
        
        return view('index')->with($info);
    }
    

}
