<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

use App\Models\Customer;
use App\Models\CustomerTemp;
use App\Models\MailTemplate;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $handle         =   "";
        $setting        =   getAllSetting();
        
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }
        
        $handle     =   $request->handle;
        $info       =   compact('setting','handle');

        return view('auth.login')->with($info);
    }

    public function signup(Request $request)
    {
        $handle         =   "";
        
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }

        $setting        =   getAllSetting();

        $handle         =   $request->handle;
        $info           =   compact('setting','handle');

        return view('auth.signup')->with($info);
    }

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }

    // After Submission

    public function submitLogin(Request $request)
    {
        $addurl     =   "";
        $handle     =   $request->handle; 
        
        if($handle)
        {
            $addurl = "?handle=$handle";
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
                
                if($handle)
                {
                    return redirect('check-out-address-select');
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

    public function submitSignup(Request $request)
    {
        $addurl     =   "";
        $handle     =   $request->handle; 
        
        if($handle)
        {
            $addurl = "?handle=$handle";
        }
        
        $request->validate([
            'name'          => 'required|max:120',
            'email'         => 'required|email|unique:customers',
            'mobile'        => 'required|digits:10|numeric|unique:customers',
            'password'      => 'required|min:5|max:50',
            'con_password'  => 'required_with:password|same:password|min:5',
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
            $mailinfo       =   MailTemplate::find('1');

            $to             =   $request->email;
            $subject        =   $mailinfo['subject'];
            $message        =   $mailinfo['body'];
            
            $user_name 		= 	$request->name;
            $user_email 	= 	$request->email;
            $user_password 	= 	$request->password;

            $message        =   @str_replace('$name',$user_name,$message);
            $message        =   @str_replace('$email',$user_email,$message);
            $message        =   @str_replace('$password',$user_password,$message);

            $ch             =   curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://mailer.beautifyu.in/mail.php");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,"to=".$to."&subject=".$subject."&message=".$message."");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json           =   curl_exec($ch);
            curl_close ($ch);

            if($handle)
            {
                return redirect('/check-out-address-select');
            }
            else
            {
                return redirect('/my-account');
            }
        }
    }

    public function submitForgotPassword(Request $request)
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

    public function signup_step1(Request $request)
    {
        $handle         =   "";
        
        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }

        $setting        =   getAllSetting();
        
        $handle         =   $request->handle;
        $info           =   compact('setting','handle');

        return view('auth.signup_step1')->with($info);
    }

    public function signup_step2(Request $request)
    {
        $handle         =   "";

        if(Session::get('beautify_customer'))
        {
            return redirect('/');
        }

        $setting        =   getAllSetting();

        $handle         =   $request->handle;
        $info           =   compact('setting','handle');

        return view('auth.signup_step2')->with($info);
    }

    public function submitSignupStep1(Request $request)
    {
        die;
        $addurl     =   "";
        $handle     =   $request->handle; 
        
        if($handle)
        {
            $addurl = "?handle=$handle";
        }
        
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
            return redirect('user-signup'.$addurl);
        }
        else
        {
            CustomerTemp::where('email',$request->email)->orWhere('mobile', $request->mobile)->delete();
            
            // Implement SMS Service
            /*
            $code       =   rand (11111,99999);
            $user       =   "mybeauty";
            $apikey     =   "LJuky1qwhnWKQsdlDdSA"; 
            $senderid   =   "MYTEXT"; 
            $mobile     =   "9773621838"; 
            $message    =   "Your BeautifyU verification code is ".$code; 
            $message    =   urlencode($message);
            $type       =  "txt";
            
            $ch         =   curl_init("http://smshorizon.co.in/api/sendsms.php?user=".$user."&apikey=".$apikey."&mobile=".$mobile."&senderid=".$senderid."&message=".$message."&type=".$type.""); 
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $output = curl_exec($ch);      
                            curl_close($ch); 
            //echo $output;

            //$otp                        =   $code;*/

            $otp                        =   '12345';
            
            $info                       =   new CustomerTemp;
            
            $info->name                 =   $request->name;
            $info->mobile               =   $request->mobile;
            $info->email                =   $request->email;
            $info->password             =   $password;
            $info->otp                  =   $otp;
            $info->save();

            $tempid                     =   $info->id;

            session(['beautify_temp_customer_id' => $tempid]);

            return redirect('/user-otp-signup'.$addurl);
        }
    }

    public function submitSignupStep2(Request $request)
    {
        $addurl     =   "";
        $handle     =   $request->handle; 
        
        if($handle)
        {
            $addurl = "?handle=$handle";
        }
        
        $request->validate([
            'temp_otp'    => 'required'
        ]);

        $temp_otp       =   $request->temp_otp;
        $temp_cusid     =   Session::get('beautify_temp_customer_id');  
        
        $exist          =   CustomerTemp::where('id',$temp_cusid)->where('otp',$temp_otp)->first();

        if($exist)
        {
            $info                       =   new Customer;
            
            $info->name                 =   $exist->name;
            $info->mobile               =   $exist->mobile;
            $info->email                =   $exist->email;
            $info->password             =   $exist->password;
            $info->is_status            =   'Active';
            $info->save();

            $newinfo                    =   Customer::where('email',$exist->email)->first();

            session(['beautify_customer' => $newinfo]);

            CustomerTemp::where('id',$temp_cusid)->delete();
            
            // Send Mail
            $mailinfo       =   MailTemplate::find('1');
            $header_param   =  ['to'   =>  'priya.16apr@gmail.com', 'subject' =>  $mailinfo['subject']];
            $body_param     =  ['name' =>  'Priyanka'];
                
            Mail::send('mail.user_registration',$body_param, function($message) use ($header_param) {
                $message->to($header_param['to']);
                $message->from('beautifyu.live@gmail.com','Beautify U');
                $message->subject($header_param['subject']);
            });

            if($handle)
            {
                return redirect('/check-out-address-select');
            }
            else
            {
                return redirect('/my-account');
            }
        }
        else
        {
            session(['auth_message'=> 'otp does not match']);
            return redirect('/user-otp-signup'.$addurl);
        }
    }
}
