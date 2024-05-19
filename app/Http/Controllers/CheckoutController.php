<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;

use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;
use App\Models\Customer;
use App\Models\MailTemplate;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $customerid     =   Session::get('beautify_customer')->id;
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

            return redirect('/check-out-address-select');
        }
        else
        {
            return redirect('/check-out-address-select');
        }
    }

    public function submitOrder(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $customerid             =   Session::get('beautify_customer')->id;
        $sessionid              =   Session::getId();
        $total_amt              =   $request->total_amt;
        $selected_address       =   $request->selected_address;

        if(!$selected_address)
        {
            return redirect('/check-out');
        }
        
        if($customerid!='' && $sessionid!='')
        {
            $cart               =   Cart::where('sessionid',$sessionid)->get();
            $addressinfo        =   Address::where('id',$selected_address)->first();
            
            if($cart!='' && $addressinfo!='')
            {
                # STEP 1: Insert in Order Address Table
                $oa_info                        =   new OrderAddress;
                $oa_info->sessionid             =   $sessionid;
                $oa_info->full_name             =   $addressinfo->full_name;
                $oa_info->email                 =   $addressinfo->email;
                $oa_info->mobile                =   $addressinfo->mobile;
                $oa_info->alter_mobile          =   $addressinfo->alter_mobile;
                $oa_info->pincode               =   $addressinfo->pincode;
                $oa_info->address_line1         =   $addressinfo->address_line1;
                $oa_info->address_line2         =   $addressinfo->address_line2;
                $oa_info->city                  =   $addressinfo->city;
                $oa_info->state                 =   $addressinfo->state;
                $oa_info->address_type          =   $addressinfo->address_type;
                $oa_info->save();
                
                # STEP 2: Insert in Order Table
                $oadata                         =   OrderAddress::where('sessionid',$sessionid)->first();
                $o_info                         =   new Order;
                $o_info->sessionid              =   $sessionid;
                $o_info->order_date             =   date('Y-m-d h:i');
                $o_info->customer_id            =   $customerid;
                $o_info->order_address_id       =   $oadata->id;
                $o_info->payment_method         =   'COD';
                $o_info->sub_total              =   $total_amt;
                $o_info->total                  =   $total_amt;
                $o_info->save();
                
                # STEP 3: Insert in Order Product Table
                $orderinfo                      =   Order::where('sessionid',$sessionid)->first();
                $orderid                        =   $orderinfo->id;

                foreach($cart as $carts)
                {
                    $op_info                        =   new OrderProduct;
                    $op_info->order_id              =   $orderid;
                    $op_info->product_id            =   $carts->product_id;
                    $op_info->product_title         =   $carts->product_name;
                    $op_info->product_image         =   $carts->product_image;
                    $op_info->product_link          =   $carts->product_link;
                    $op_info->product_price         =   $carts->product_price;
                    $op_info->product_qty           =   $carts->product_qty;
                    $op_info->sub_total             =   $carts->sub_total;
                    $op_info->info                  =   $carts->cart_info;
                    $op_info->save(); 
                }

                Cart::where('sessionid',$sessionid)->delete();
                session()->regenerate();

                // Invoice
                // $pdfname        =   $orderid.'_invoice.pdf';        
                // $loadtemplate   =   "mail.invoice";
                // $pdf            =   PDF::loadView($loadtemplate);
                // return $pdf->download($pdfname);
                // return view($loadtemplate)->with(array('name'=>'priyanka'));
                
                // Send Mail
                $custinfo       =   Customer::where('id',$customerid)->first();
                $mailinfo       =   MailTemplate::find('3');
                $header_param   =  ['to'   =>  $custinfo->email, 'subject' =>  $mailinfo['subject']];
                $body_param     =  ['name' =>  $custinfo->name,  'orderid' =>  'orderid', 'total_amt' =>  $total_amt];
            
                //sendMail('mail.order_confirmed',$body_param,$header_param);
                
                $pass           =   '343-'.$orderid.'-908';
                
                return redirect("/thank-you-for-shopping-with-us/$pass");  
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }

    public function thankForShopping($oidd)
    {
        $setting    =   getAllSetting();
        
        $oid        =   @explode('-',$oidd);
        
        $detail     =   Order::find($oid[1]);
        $data       =   compact('setting','detail');

        return view('shopping.thankyforshopping')->with($data);
    }

    // Template - Checkout in three steps
    public function checkOutStep1()
    {
        if(!Session::get('beautify_customer') || !Session::get('cart_total'))
        {
            return redirect('/');
        }
        
        $customerid     =   Session::get('beautify_customer')->id;
        $address        =   Address::where('customer_id',$customerid)->get();
        $data           =   compact('address');

        return view('shopping.checkout_step1')->with($data);
    }

    public function checkOutStep2(Request $request)
    {
        if(!Session::get('beautify_customer') || !Session::get('cart_total') || !Session::get('sel_addressid'))
        {
            return redirect('/');
        }
        
        $addressId      =   Session::get('sel_addressid');
        $address        =   Address::where('id',$addressId)->first();
        
        $data           =   compact('address');

        return view('shopping.checkout_step2')->with($data);
    }

    public function checkOutStep3(Request $request)
    {
        if(!Session::get('beautify_customer') || !Session::get('cart_total') || !Session::get('sel_addressid') || !Session::get('sel_pmethod'))
        {
            return redirect('/');
        }

        $sessionid      =   Session::getId();
        $addressId      =   Session::get('sel_addressid');
        $pMethod        =   Session::get('sel_pmethod');
        
        $address        =   Address::where('id',$addressId)->first();
        $cart           =   Cart::where('sessionid',$sessionid)->get();

        $data           =   compact('address','pMethod','cart');

        return view('shopping.checkout_step3')->with($data);
    }

    // Submission - Checkout in three steps
    public function submitcheckOutStep1(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $customerid             =   Session::get('beautify_customer')->id;
        $sessionid              =   Session::getId();
        $total_amt              =   Session::get('cart_total');
        
        session(['sel_addressid' => $request->selected_address]);
        
        if($customerid!='' && $sessionid!='' && $total_amt!='' && $request->selected_address!='')
        {
            return redirect("/check-out-pay-select");
        }
        else
        {
            return redirect('/');
        }
    }

    public function submitcheckOutStep2(Request $request)
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $customerid             =   Session::get('beautify_customer')->id;
        $sessionid              =   Session::getId();
        $total_amt              =   Session::get('cart_total');
        $selected_address       =   Session::get('sel_addressid');
        session(['sel_pmethod' => $request->pmethod]);

        if($customerid=='' || $sessionid=='' || $total_amt=='' || $selected_address=='' ||  $request->pmethod=='')
        {
            return redirect("/");
        }
        else
        {
            return redirect("/check-out-review");
        }
    }

    public function submitcheckOutStep3()
    {
        if(!Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $customerid             =   Session::get('beautify_customer')->id;
        $sessionid              =   Session::getId();
        $total_amt              =   Session::get('cart_total');
        $selected_address       =   Session::get('sel_addressid');
        $pMethod                =   Session::get('sel_pmethod');

        if(!$customerid || !$sessionid || !$total_amt || !$selected_address)
        {
            return redirect('/');
        }
        
        if($customerid!='' && $sessionid!='')
        {
            $cart               =   Cart::where('sessionid',$sessionid)->get();
            $addressinfo        =   Address::where('id',$selected_address)->first();
            
            if($cart!='' && $addressinfo!='')
            {
                # STEP 1: Insert in Order Address Table
                $oa_info                        =   new OrderAddress;
                $oa_info->sessionid             =   $sessionid;
                $oa_info->full_name             =   $addressinfo->full_name;
                $oa_info->email                 =   $addressinfo->email;
                $oa_info->mobile                =   $addressinfo->mobile;
                $oa_info->alter_mobile          =   $addressinfo->alter_mobile;
                $oa_info->pincode               =   $addressinfo->pincode;
                $oa_info->address_line1         =   $addressinfo->address_line1;
                $oa_info->address_line2         =   $addressinfo->address_line2;
                $oa_info->city                  =   $addressinfo->city;
                $oa_info->state                 =   $addressinfo->state;
                $oa_info->address_type          =   $addressinfo->address_type;
                $oa_info->save();
                
                # STEP 2: Insert in Order Table
                $oadata                         =   OrderAddress::where('sessionid',$sessionid)->first();
                $o_info                         =   new Order;
                $o_info->sessionid              =   $sessionid;
                $o_info->order_date             =   date('Y-m-d h:i');
                $o_info->customer_id            =   $customerid;
                $o_info->order_address_id       =   $oadata->id;
                $o_info->payment_method         =   $pMethod;
                $o_info->sub_total              =   $total_amt;
                $o_info->total                  =   $total_amt;
                $o_info->save();
                
                # STEP 3: Insert in Order Product Table
                $orderinfo                      =   Order::where('sessionid',$sessionid)->first();
                $orderid                        =   $orderinfo->id;

                foreach($cart as $carts)
                {
                    $op_info                        =   new OrderProduct;
                    $op_info->order_id              =   $orderid;
                    $op_info->product_id            =   $carts->product_id;
                    $op_info->product_title         =   $carts->product_name;
                    $op_info->product_image         =   $carts->product_image;
                    $op_info->product_link          =   $carts->product_link;
                    $op_info->product_color         =   $carts->product_color;
                    $op_info->product_mrp           =   $carts->product_mrp; 
                    $op_info->product_price         =   $carts->product_price;
                    $op_info->product_qty           =   $carts->product_qty;
                    $op_info->sub_total             =   $carts->sub_total;
                    $op_info->info                  =   $carts->cart_info;
                    $op_info->save(); 
                }

                Cart::where('sessionid',$sessionid)->delete();
                session()->regenerate();

                // Invoice
                // $pdfname        =   $orderid.'_invoice.pdf';        
                // $loadtemplate   =   "mail.invoice";
                // $pdf            =   PDF::loadView($loadtemplate);
                // return $pdf->download($pdfname);
                // return view($loadtemplate)->with(array('name'=>'priyanka'));
                
                // Send Mail
                $mailinfo       =   MailTemplate::find('3');
                $custinfo       =   Customer::where('id',$customerid)->first();

                $to             =   $custinfo->email;
                $subject        =   $mailinfo['subject'];
                $message        =   $mailinfo['body'];
                
                $user_name 		= 	$custinfo->name;
                $user_total_amt = 	$total_amt;
                $user_orderid 	= 	$orderid;

                $message        =   @str_replace('$name',$user_name,$message);
                $message        =   @str_replace('$orderid','BU#'.$user_orderid,$message);
                $message        =   @str_replace('$total_amt',"₹ ".$user_total_amt,$message);

                $ch             =   curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://mailer.beautifyu.in/mail.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"to=".$to."&subject=".$subject."&message=".$message."");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json           =   curl_exec($ch);
                curl_close ($ch);

                $pass           =   '343-'.$orderid.'-908';
                
                return redirect("/thank-you-for-shopping-with-us/$pass");  
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }

}
