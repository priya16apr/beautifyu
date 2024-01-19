<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Customer;
use App\Models\Address;

class CustomerController extends Controller
{
    public function myAccount()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $cusid  =   Session::get('beautify_customer')['id'];  
        
        if(!$cusid)
        {
            return redirect('/');
        }

        $userinfo   =   Session::get('beautify_customer');
        $info       =   compact('userinfo');

        return view('myaccount.index')->with($info);;
    }

    public function myProfileEdit()
    {
        $userinfo   =   Session::get('beautify_customer');
        $info       =   compact('userinfo');

        return view('myaccount.editprofile')->with($info);
    }

    public function submitProfile()
    {
        return redirect('/my-account');
    }

    public function myAddress()
    {
        $cusid          =   Session::get('beautify_customer')['id'];
        $address        =   Address::where('customer_id',$cusid)->get();
       
        $info           =   compact('address');
        
        return view('myaccount.address')->with($info);
    }

    public function address_by_id($id)
    {
        $detail     =  Address::where('id',$id)->first();
        $info       =  compact('detail');
        
        return view('myaccount.detail_address')->with($info);
    }

    public function myOrder()
    {
        // $cusid  =   Session::get('beautify_customer')->id;   
        
        // $data   =   Order::where('customer_id',$id)->get();
        // $info   =   compact('data');
        
        return view('myaccount.order');
    }

    public function order_by_id($id)
    {
        $detail    =  Order::where('id',$id)->first();
        $info      =  compact('detail');
        
        return view('myaccount.detail_order')->with($info);
    }

    public function myWishlist()
    {
        // $cusid  =   Session::get('beautify_customer')->id;   
        
        // $data   =   Wishlist::where('customer_id',$id)->get();
        // $info   =   compact('data');
        
        return view('myaccount.wishlist');
    }

    function myPasswordChange()
    {
        return view('myaccount.changepassword');
    }

    function submitPassword(Request $request)
    {
        $request->validate([
            'old_password'          => 'required',
            'new_password'          => 'required|different:old_password',
            'confirmed_password'    => 'required|same:new_password'
        ]);
       
        $cusid          =   Session::get('beautify_customer')['id'];
        $info           =   Customer::where('id',$cusid)->first();
        
        if($info)
        {   
            if(Hash::check(request('old_password'), $info->password)==1)
            {
                $info->password    =   Hash::make($request->new_password);
                $info->save();
                session(['message'=> 'password has been updated successfully.']);
                session(['message_class'=> 'primary']);
            }
            else
            {
                session(['message'=> 'old password does not match']);
                session(['message_class'=> 'secondary']);
            }
        }
        
        return redirect('myaccount.changepassword');
    }

}
