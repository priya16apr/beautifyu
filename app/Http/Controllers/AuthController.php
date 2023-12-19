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
            'email'      => 'required',
            'password'   => 'required'
        ]);
        
        $email      =   $request->email;
        $password   =   Hash::make($request->password);
        
        $data       =   Customer::where('email',$email)->where('is_status','Active')->first();
        
        if($data)
        {
            if(Hash::check(request('password'), $data->password)==1)
            {
                session(['beautify_customer' => $data]);
                return redirect('/');
            }
            else
            {
                session(['message'=> 'email/password is incorrect']);
                return redirect('login');
            }
        }
        else
        {
            session(['message'=> 'email/password is incorrect']);
            return redirect('login');
        }
    }

    public function submitLogout()
    {
        session(['beautify_customer'=> '']);
        return redirect('login');
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
