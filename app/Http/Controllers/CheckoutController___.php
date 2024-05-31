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
                $orderaddressId        =   $oa_info->id;

                # STEP 2: Insert in Order Table
                //$oadata                         =   OrderAddress::where('sessionid',$sessionid)->first();
                $oadata                         =   OrderAddress::where('id',$orderaddressId)->first();
                $o_info                         =   new Order;
                $o_info->sessionid              =   $sessionid;
                $o_info->order_date             =   date('Y-m-d h:i');
                $o_info->customer_id            =   $customerid;
                $o_info->order_address_id       =   $oadata->id;
                $o_info->payment_method         =   $pMethod;
                $o_info->sub_total              =   $total_amt;
                $o_info->total                  =   $total_amt;
                $o_info->save();
                $orderid        =   $o_info->id;
                
                # STEP 3: Insert in Order Product Table
                //$orderinfo                      =   Order::where('sessionid',$sessionid)->first();
                //$orderid                        =   $orderinfo->id;

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

                /************   API: RAZOR PAY   ************/

                if($pMethod=='UPI')
                {   
                    $keyId      =   "rzp_live_IlnGc7DsAGGosj";
                    $keySecret  =   "PeWxKXD4PsZGo2UnuPIez88M";
                    $payUrl     =   "https://api.razorpay.com/v1/orders";

                    $data       =   array(
                                    "amount"    =>  $total_amt, 
                                    "currency"  =>  "INR", 
                                    "receipt"   =>  "$orderid",
                                    "notes"     =>  array(
                                                    "name"      =>  $addressinfo->full_name,
                                                    "email"     =>  $addressinfo->email
                                                    )
                                    );

                    $data       =   json_encode($data);                
                    $ch         =   curl_init();
                    
                    curl_setopt($ch, CURLOPT_URL, $payUrl);
                    curl_setopt($ch, CURLOPT_USERPWD, $keyId . ':' . $keySecret);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,array('content-type:application/json'));
                    
                    $response       =   curl_exec($ch);
                    
                    if (!curl_errno($ch)) 
                    {
                        //print_r($response);

                        $decode             =   json_decode($response);
                        $razorOrderStatus   =   $decode->status;

                        $orderinfoo                         =   Order::where('id',$orderid)->first();
                        $orderinfoo->razorOrderStatus       =   $razorOrderStatus;
                        $orderinfoo->razorInfo              =   $response;
                        $orderinfoo->save();

                        curl_close($ch);
                        
                        if($razorOrderStatus=='paid')
                        {
                            Cart::where('sessionid',$sessionid)->delete();
                            session()->regenerate();
                            
                            /************   SEND MAIL   ************/
                
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
                            // stage [created/attempted]
                            return redirect("/payment-error-page"); 
                        }
                    }
                    else
                    {
                        // if (curl_errno($ch)) 
                        // {
                        //     echo 'Error:' . curl_error($ch);
                        // }
                        return redirect("/something-went-wrong-with-order"); 
                    }
                }
                else
                {
                    Cart::where('sessionid',$sessionid)->delete();
                    session()->regenerate();

                    /************   SEND MAIL   ************/
                
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

        // Invoice
        // $pdfname        =   $orderid.'_invoice.pdf';        
        // $loadtemplate   =   "mail.invoice";
        // $pdf            =   PDF::loadView($loadtemplate);
        // return $pdf->download($pdfname);
        // return view($loadtemplate)->with(array('name'=>'priyanka'));
    }

}
