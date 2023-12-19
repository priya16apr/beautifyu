<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

class ContentController extends Controller
{
    public function content_by_slug($slug)
    {
        $content    =  Content::where('slug',$slug)->first();
        $info       =  compact('content');
        
        return view('content.detail')->with($info);
    }

}
