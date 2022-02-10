<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendMail(){
        $details=[
            'title'=>'mail from ecommerce',
            'body'=>'this is for testing mail using laravel',
            ];
        Mail::to(['michoessam16@gmail.com'])->send(new TestMail($details));
        return 'email sent';
    }
}
