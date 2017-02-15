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
        Mail::raw(
            "<h2>
                Submit:
            </h2>
            <h6>
                name:{$name},
                message:{$message}
            </h6>",
            function ($message) {
                    $message->from('dev@starin.biz')
                        ->to('happinesseric525@gmail.com')
                        ->subject('okay');
                }
        );
        return 'success';
    }
}
