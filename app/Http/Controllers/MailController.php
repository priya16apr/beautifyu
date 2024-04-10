<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\mail;

class MailController extends Controller
{
    public static function getContent($id)
    {
        $content        =   Mail::where('id',$id)->first();
        return $content;
    }

}
