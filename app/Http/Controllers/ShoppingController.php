<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Cart;
use App\Models\Address;

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

    public function submitEditCart(Request $request)
    {
        $id             =   $request->id;
        $productid      =   $request->productid;
        $price          =   $request->price;
        $qty            =   $request->qty;
        $subtotal       =   $price*$qty;
        
        if($productid)
        {
            $info                       =   Cart::find($id);
    
            $info->product_price        =   $price;
            $info->quantity             =   $qty;
            $info->sub_total            =   $subtotal;

            $info->save();

            echo 'updated';
        }
        else
        {
            echo 'something went wrong.';
        }

        //     $info   =   Cart::find($id);
        //     $info->delete();
    }

    public function checkOut()
    {
        $customerid     = Session::get('beautify_customer')->id;
        $address        =   Address::where('customer_id',$customerid)->get();
        $data           =   compact('address');

        return view('shopping.checkout')->with($data);
    }

    public function submitAddAddress(Request $request)
    {
        $customerid             =   $request->customerid;
        $add_pincode            =   $request->add_pincode;
        $add_name               =   $request->add_name;
        $add_email              =   $request->add_email;
        $add_address1           =   $request->add_address1;
        $add_address2           =   $request->add_address2;
        $add_city               =   $request->add_city;
        $add_state              =   $request->add_state;
        $add_mobile             =   $request->add_mobile;
        $add_alter_mobile       =   $request->add_alter_mobile;
        $address_type           =   $request->address_type;

        if($customerid)
        {
            $info                       =   new Address;
            
            $info->customer_id          =   $customerid;
            $info->full_name            =   $add_name;
            $info->email                =   $add_email;
            $info->mobile               =   $add_mobile;
            $info->alter_mobile         =   $add_alter_mobile;
            $info->pincode              =   $add_pincode;
            $info->address_line1        =   $add_address1;
            $info->address_line2        =   $add_address2;
            $info->city                 =   $add_city;
            $info->state                =   $add_state;
            $info->address_type         =   $address_type;
            
            $info->save();

            return redirect('/check-out');
        }
        else
        {
            return redirect('/check-out');
        }
    }

    public function thankyou()
    {
        return view('shopping.thankyou');
    }

}
