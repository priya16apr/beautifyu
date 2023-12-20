<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

use App\Models\Customer;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
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
                return redirect('/my-account');
            }
            else
            {
                session(['message'=> 'mobile no/password is incorrect']);
                return redirect('user-login');
            }
        }
        else
        {
            session(['message'=> 'mobile no is incorrect']);
            return redirect('user-login');
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
        return view('auth.signup');
    }

    public function submitSignup(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'email'      => 'required',
            'mobile'     => 'required',
            'password'   => 'required'
        ]);
        
        $password       =   Hash::make($request->password);
        $exist          =   Customer::where('email',$request->email)->first();
        
        if($exist)
        {
            session(['message'=> 'email is already exist.']);
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

            return redirect('/my-account');
            //return redirect($this->module);
        }
    }
    
    
}
