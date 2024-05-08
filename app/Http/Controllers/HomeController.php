<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\HomeuiBanner;
use App\Models\HomeuiUsp;
use App\Models\Product;
use App\Models\HappyCustomer;

use Illuminate\Support\Facades\Mail;
use App\Models\MailTemplate;

class HomeController extends Controller
{
    public function index()
    {
        // $mailinfo       =   MailTemplate::find('1');
        // $header_param   =  ['to'   =>  'priya.16apr@gmail.com', 'subject' =>  $mailinfo['subject']];
        // $body_param     =  ['name' =>  'Priyanka'];
            
        // Mail::send('mail.user_registration',$body_param, function($message) use ($header_param) {
        //     $message->to($header_param['to']);
        //     $message->from('beautifyu.live@gmail.com','Beautify U');
        //     $message->subject($header_param['subject']);
        // });
    
        
        $setting        =  getAllSetting();
      
        $date           =   date('Y-m-d');
        
        $topbanner      =  HomeuiBanner::where('type','Top Banner')->get();
        $usp            =  HomeuiUsp::get();
        
        $p_arrival      =  Product::where('status','4')->orderby('id','desc')->paginate('12');
        $p_trending     =  Product::where('status','4')->orderby('id','desc')->paginate('12');
        $p_celeb        =  Product::where('status','4')->where('is_celeb','Yes')->paginate('4');
        $p_combo        =  Product::where('status','4')->where('producttype_id','7')->paginate('4');
        $p_deal         =  Product::where('status','4')->where('deal_status','Deal')->where('deal_start_date','<=',$date)->where('deal_end_date','>=',$date)->get();
       
        $hcustomer      =  HappyCustomer::where('is_visible','Yes')->orderby('id','desc')->get();
        
        $info           =  compact('setting','topbanner','usp','p_arrival','p_trending','p_celeb','p_combo','p_deal','hcustomer');
        
        return view('index')->with($info);
    }

}
