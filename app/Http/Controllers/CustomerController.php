<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;

use App\Models\Customer;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;

class CustomerController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function myAccount()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
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
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $userinfo   =   Session::get('beautify_customer');
        $info       =   compact('userinfo');

        return view('myaccount.editprofile')->with($info);
    }

    public function myAddress()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $cusid          =   Session::get('beautify_customer')['id'];
        $address        =   Address::where('customer_id',$cusid)->get();
       
        $userinfo       =   Session::get('beautify_customer');

        $info           =   compact('address','userinfo');
        
        return view('myaccount.address')->with($info);
    }
  
    public function myAddressEdit($id)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $detail     =  Address::where('id',$id)->first();
        $userinfo   =   Session::get('beautify_customer');
        
        $info       =  compact('detail','userinfo');
        
        return view('myaccount.editaddress')->with($info);
    }

    public function myAddressDefault($id)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $customerid         =   Session::get('beautify_customer')['id']; 
        $info               =   Address::where('customer_id',$customerid)->get();
        if($info)
        {
            foreach($info as $infos)
            {
                if($infos->id==$id) 
                { 
                    $infos->is_default     =   'Yes';
                }
                else
                {
                    $infos->is_default     =   'No';
                }
                $infos->save();
            }
        }  

        return redirect('/my-account/address');
    }

    public function myOrder()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $allinfo[]['order']       =   array();
        
        $cusid      =   Session::get('beautify_customer')->id;   
        $userinfo   =   Session::get('beautify_customer');

        $order      =   Order::where('customer_id',$cusid)->orderBy('id','DESC')->get();
        if($order)
        {
            foreach($order as $key=>$orders)
            {
                $allinfo[$key]["order"]     =   $orders;
                $allinfo[$key]['product']   =   array();
                
                $product   =  OrderProduct::where('order_id',$orders->id)->get();
                if($product)
                {
                    foreach($product as $key1=>$products)
                    {
                        $allinfo[$key]['product'][$key1] = $products;
                    }
                }
            }
        }
        
        $info       =   compact('allinfo','userinfo');
        
        return view('myaccount.order')->with($info);
    }

    public function myOrderDetail($id)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $detail    =  Order::where('id',$id)->first();
        $product   =  OrderProduct::where('order_id',$id)->get();
        
        $info      =  compact('detail','product');

        return view('myaccount.detail_order')->with($info);
    }

    public function myWishlist()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        // $cusid  =   Session::get('beautify_customer')->id;   
        
        // $data   =   Wishlist::where('customer_id',$id)->get();
        // $info   =   compact('data');
        
        return view('myaccount.wishlist');
    }

    function myPasswordChange()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $userinfo   =   Session::get('beautify_customer');
        $info       =   compact('userinfo');

        return view('myaccount.changepassword')->with($info);
    }

    public function submitProfile(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $request->validate([
            'name'          => 'required'
        ]);

        $cusid              =   Session::get('beautify_customer')['id'];
        $info               =   Customer::where('id',$cusid)->first();
        
        if($info)
        {   
            $info->name     =   $request->name;
            $info->gender   =   $request->gender;
            $info->dob      =   $request->dob;
            $info->save();

            $data           =   Customer::where('id',$cusid)->first();
            session(['beautify_customer' => $data]);
        }
        
        return redirect('/my-account');
    }

    public function submitAddAddress(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

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
        $is_default             =   $request->is_default; 

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
            $info->is_default           =   $is_default;
            $info->save();

            return redirect('/my-account/address');
        }
        else
        {
            return redirect('/');
        }
    }

    public function submitEditAddress(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $address_id              =   $request->address_id;
        $edit_pincode            =   $request->edit_pincode;
        $edit_name               =   $request->edit_name;
        $edit_email              =   $request->edit_email;
        $edit_address1           =   $request->edit_address1;
        $edit_address2           =   $request->edit_address2;
        $edit_city               =   $request->edit_city;
        $edit_state              =   $request->edit_state;
        $edit_mobile             =   $request->edit_mobile;
        $edit_alter_mobile       =   $request->edit_alter_mobile;
        $address_type            =   $request->address_type;

        if($address_id)
        {
            $info                       =   Address::find($address_id);
            
            $info->full_name            =   $edit_name;
            $info->email                =   $edit_email;
            $info->mobile               =   $edit_mobile;
            $info->alter_mobile         =   $edit_alter_mobile;
            $info->pincode              =   $edit_pincode;
            $info->address_line1        =   $edit_address1;
            $info->address_line2        =   $edit_address2;
            $info->city                 =   $edit_city;
            $info->state                =   $edit_state;
            $info->address_type         =   $address_type;
            
            $info->save();

            return redirect('/my-account/address');
        }
        else
        {
            return redirect('/');
        }
    }

    public function submitDelAddress(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

        $address_id              =   $request->id;
        
        if($address_id)
        {
            Address::destroy($address_id);

            return redirect('/my-account/address');
        }
        else
        {
            return redirect('/');
        }
    }

    function submitPassword(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/user-login');
        }

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
        
        return redirect('my-account/password-change');
    }

}
