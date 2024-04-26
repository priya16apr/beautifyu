<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;

class ShoppingController extends Controller
{
    public function cart()
    {
        $sessionid      =   Session::getId();

        $setting        =   getAllSetting();
        $cart           =   Cart::with('product')->where('sessionid',$sessionid)->get();
        $count_cart     =   Cart::where('sessionid',$sessionid)->sum('product_qty');
        $data           =   compact('setting','cart','count_cart');

        return view('shopping.cart')->with($data);
    }

    public function submitAddCart(Request $request)
    {
        $productid      =   $request->product_id;
        $name           =   $request->product_name;
        $image          =   $request->product_image;
        $link           =   $request->product_link;
        $color          =   $request->product_color;
        $mrp            =   $request->product_mrp;
        $price          =   $request->product_price;
        $qty            =   $request->product_qty;
        $subtotal       =   $price*$qty;
        $cart_info      =   $request->cart_info;
        
        $sessionid      =   Session::getId();
        
        if($productid)
        {
            $info                       =   new Cart;
    
            $info->sessionid            =   $sessionid;
            $info->product_id           =   $productid;
            $info->product_name         =   $name;
            $info->product_image        =   $image;
            $info->product_link         =   $link;
            $info->product_color        =   $color;
            $info->product_mrp          =   $mrp;
            $info->product_price        =   $price;
            $info->product_qty          =   $qty;
            $info->sub_total            =   $subtotal;
            $info->cart_info            =   $cart_info;

            $info->save();

            $sum    =   Cart::where('sessionid','=',$sessionid)->sum('sub_total');
            session(['cart_total' => $sum]);

            echo 'added';
        }
        else
        {
            echo 'something went wrong.';
        }
    }

}
