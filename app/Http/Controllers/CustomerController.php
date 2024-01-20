<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Order;

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
        $cusid  =   Session::get('beautify_customer')->id;   
        
        $order  =   Order::where('customer_id',$cusid)->orderBy('id','DESC')->get();
        $info   =   compact('order');
        
        return view('myaccount.order')->with($info);
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

    public function submitProfile(Request $request)
    {
        $request->validate([
            'name'          => 'required'
        ]);

        $cusid              =   Session::get('beautify_customer')['id'];
        $info               =   Customer::where('id',$cusid)->first();
        
        if($info)
        {   
            $info->name     =   $request->name;
            $info->save();

            $data           =   Customer::where('id',$cusid)->first();
            session(['beautify_customer' => $data]);
        }
        
        return redirect('/my-account');
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

            return redirect('/my-account/address');
        }
        else
        {
            return redirect('/');
        }
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
