<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

class ContentController extends Controller
{
    public function content_by_slug($slug)
    {
        $content    =  Content::where('slug',$slug)->first();
        if(!$content)
        {
            return redirect('/404-page-not-found');
        }

        $info       =  compact('content');
        
        return view('content.detail')->with($info);
    }

    public function notFound()
    {
        return view('content.notfound');
    }

    public function paymentError()
    {
        return view('content.paymentError');
    }
    
    public function orderError()
    {
        return view('content.orderError');
    }

    public function requestForgotPassword()
    {
        return view('content.requestforgotpassword');
    }

}
