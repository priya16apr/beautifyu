<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Cart;

class ShoppingController extends Controller
{
    public function cart()
    {
        
        return view('shopping.cart');
    }

    public function submitCart($type)
    {
        if($type=='add')
        {
            $info   =   new Cart;
            $info->save();
        }

        if($type=='edit')
        {
            $info   =   Cart::find($id);
            $info->save();
        }

        if($type=='delete')
        {
            $info   =   Cart::find($id);
            $info->delete();
        }

        return redirect('shopping.cart');
    }

    public function shippingaddress()
    {
        
        return view('shopping.shipping_address');
    }

    public function submitShippingaddress()
    {
        
        return redirect('shopping.checkout');
    }

    public function checkout()
    {
        return view('shopping.checkout');
    }

    public function submitCheckout()
    {
        return view('shopping.checkout');
    }

    public function thankyou()
    {
        return view('shopping.thankyou');
    }

}
