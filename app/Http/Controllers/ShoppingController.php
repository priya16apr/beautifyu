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

        $cart           =   Cart::where('sessionid',$sessionid)->get();
        $data           =   compact('cart');

        return view('shopping.cart')->with($data);
    }

    public function submitAddCart(Request $request)
    {
        $productid      =   $request->product_id;
        $name           =   $request->product_name;
        $image          =   $request->product_image;
        $link           =   $request->product_link;
        $price          =   $request->product_price;
        $qty            =   $request->product_qty;
        
        $subtotal       =   $price*$qty;
        $sessionid      =   Session::getId();
        
        if($productid)
        {
            $info                       =   new Cart;
    
            $info->sessionid            =   $sessionid;
            $info->product_id           =   $productid;
            $info->product_name         =   $name;
            $info->product_image        =   $image;
            $info->product_link         =   $link;
            $info->product_price        =   $price;
            $info->product_qty          =   $qty;
            $info->sub_total            =   $subtotal;

            $info->save();

            echo 'added';
        }
        else
        {
            echo 'something went wrong.';
        }
    }

}
