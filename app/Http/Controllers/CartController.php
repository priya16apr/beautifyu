<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Cart;

class CartController extends Controller
{
    public function increaseQuantity()
    {
        $cartid             =   $_GET['cartid'];
        $single_product     =   Cart::find($cartid);

        $qty            =   $single_product->product_qty + 1;
        
        if($qty>3)
        {
            echo 'you can not buy more than 3 quantity.';
        }
        else
        {
            $product_price  =   $single_product->product_price; 
        
            $single_product->product_qty    =   $qty;
            $single_product->sub_total      =   $product_price * $qty;
            $single_product->save();
    
            echo 'updated';
        }
    }

    public function decreaseQuantity()
    {
        $cartid             =   $_GET['cartid'];
        $single_product     =   Cart::find($cartid);

        $qty            =   $single_product->product_qty - 1;

        if($qty<1)
        {
            Cart::find($cartid)->delete();

            echo 'removed';
        }
        else
        {
            $product_price  =   $single_product->product_price; 
        
            $single_product->product_qty    =   $qty;
            $single_product->sub_total      =   $product_price * $qty;
            $single_product->save();
    
            echo 'updated';
        }
    }

    public function deleteProduct()
    {
        $cartid             =   $_GET['cartid'];
        
        Cart::find($cartid)->delete();

        echo 'removed';
    }

    public function empty()
    {
        $sessionid      =   Session::getId();
        Cart::where('sessionid',$sessionid)->delete();

        echo 'empty';
    }

}
