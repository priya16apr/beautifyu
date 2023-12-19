<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\HomeuiBanner;
use App\Models\HomeuiUsp;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $topbanner      =  HomeuiBanner::where('type','Top Banner')->get();
        $usp            =  HomeuiUsp::get();
        
        $p_arrival      =  Product::paginate('12');
        $p_trending     =  Product::paginate('12');
        $p_celeb        =  Product::paginate('4');
        $p_combo        =  Product::paginate('4');
        $p_deal         =  Product::paginate('4');
       
        $probanner      =  HomeuiBanner::where('type','Promotional Banner')->where('status','Active')->get();
        
        $info           =  compact('topbanner','usp','p_arrival','p_trending','p_celeb','p_combo','p_deal','probanner');
        
        return view('index')->with($info);
    }
    

}
