<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\MailTemplate;

class MailTemplateController extends Controller
{
    public static function getContent($id)
    {
        $content        =   MailTemplate::where('id',$id)->first();
        return $content;
    }

}
