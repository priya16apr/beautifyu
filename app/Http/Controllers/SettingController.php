<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Content;

class SettingController extends Controller
{
    public static function getContentPage()
    {
        $content    =   Content::where('is_visible','1')->orderBy('sequence','asc')->get();
        if($content)
        {
            foreach($content as $contents)
            {
                $contentid      =   $contents['id'];
                $contentname    =   $contents['title'];
                $contentslug    =   $contents['slug'];
                
                echo "<li><a href='/content/".$contentslug."'>".$contentname."</a></li>";
            }
        }
    }

}
