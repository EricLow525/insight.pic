<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;

class AboutController extends Controller
{
    //
    public function sendmsg(Request $request){
        $name=$request->name;
        $email=$request->email;
        $message=$request->message;
        $sendemail=env('SUPPORT_ADDRESS');
        $servername=env('MAIL_USERNAME');
        Mail::raw(
            "Submit:
                name:{$name},
                message:{$message}",
            function ($message)use($servername,$sendemail){
                $message->from($servername)
                        ->to($sendemail)
                        ->subject('Message from Insight.pic');
            }
        );
        return 'success';
    }
}
