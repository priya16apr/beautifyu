<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

use App\Models\Customer;
use App\Models\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $setting        =   getAllSetting();
        
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $page = $request->p;

        if($page)
        {
            $info       =   compact('setting','page');
        }
        else
        {
            $page       =   "";
            $info       =   compact('setting','page');
            
        }  

        return view('auth.login')->with($info);
    }

    public function submitLogin(Request $request)
    {
        $addurl     =   "";
        $flow_page  =   $request->flow_page; 
        
        if($flow_page)
        {
            $addurl = "?p=shop";
        }

        $request->validate([
            'user_mobile'      => 'required',
            'user_password'    => 'required'
        ]);
        
        $mobile     =   $request->user_mobile;
        $password   =   Hash::make($request->user_password);     
        
        $data       =   Customer::where('mobile',$mobile)->where('is_status','Active')->first();
        
        if($data)
        {
            if(Hash::check(request('user_password'), $data->password)==1)
            {
                session(['beautify_customer' => $data]);
                
                if($flow_page)
                {
                    return redirect('check-out');
                }
                else
                {
                    return redirect('/my-account');
                }
            }
            else
            {
                session(['auth_message'=> 'mobile no/password is incorrect']);
                return redirect('user-login'.$addurl);
            }
        }
        else
        {
            session(['auth_message'=> 'mobile no is incorrect']);
            return redirect('user-login'.$addurl);
        }
    }

    public function logout()
    {
        //session(['beautify_customer'=> '']);
        //Session::forget('beautify_customer');
        // echo Session::getId();
        // echo "<br/>";
        // Session::flush();
        // session()->regenerate();
        // echo Session::getId();

        Session::flush();
        session()->regenerate();
        return redirect('user-login');
    }

    public function signup()
    {
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }

        $setting        =   getAllSetting();
        $info           =   compact('setting');

        return view('auth.signup')->with($info);
    }

    public function submitSignup(Request $request)
    {
        $request->validate([
            'name'       => 'required|max:120',
            'email'      => 'required|email|unique:customers',
            'mobile'     => 'required|digits:10|numeric|unique:customers',
            'password'   => 'required|min:5|max:50'
        ]);
        
        $password       =   Hash::make($request->password);
        $exist          =   Customer::where('email',$request->email)->orWhere('mobile', $request->mobile)->first();

        if($exist)
        {
            session(['auth_message'=> 'email id / mobile is already exist.']);
            return redirect('user-signup');
        }
        else
        {
            $info                       =   new Customer;
            
            $info->name                 =   $request->name;
            $info->mobile               =   $request->mobile;
            $info->email                =   $request->email;
            $info->password             =   $password;
            $info->is_status            =   'Active';

            $info->save();

            $newinfo                    =   Customer::where('email',$request->email)->first();

            session(['beautify_customer' => $newinfo]);

            // Send Mail
            $mailinfo       =   Mail::find('1');
            $header_param   =  ['to'   =>  $request->email, 'subject' =>  $mailinfo['subject']];
            $body_param     =  ['name' =>  $request->name,  'mobile'  =>  $request->mobile, 'email' =>  $request->email, 'password' =>  $request->password];
            
            sendMail('mail.user_registration',$body_param,$header_param);

            return redirect('/my-account');
        }
    }

    public function forgot_password ()
    {
        return view('auth.forgot_password');
    }


    public function submitForgotPassword (Request $request)
    {
        $request->validate([
            'user_email'   => 'required'
        ]);

        // Send Mail
        $exist          =   Customer::where('email',$request->user_email)->first();

        if($exist)
        {
            $mailinfo       =   Mail::find('2');
            $header_param   =  ['to'   =>  $request->user_email, 'subject' =>  $mailinfo['subject']];
            $body_param     =  ['name' =>  $exist->name,  'mobile'  =>  $exist->mobile, 'email' =>  $exist->email, 'password' =>  $exist->password];
            
            sendMail('mail.forgot_password',$body_param,$header_param);

            return redirect('/request-for-forget-password');
        }
        else
        {
            session(['forgot_message'=> 'Email Id is incorrect']);
            return redirect('/user-forgot-password');
        }
        
    }


    // Registration in two Steps

    public function signup_step1()
    {
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        return view('auth.signup_step1');
    }

    public function submitSignupStep1()
    {
        $mobile =   @$_REQUEST['mobile'];

        if($mobile)
        {
            //
            echo 'otp_ok';
        }
        else
        {

        }

        echo '***';
        
    }
}
