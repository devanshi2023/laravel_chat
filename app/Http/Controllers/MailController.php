<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class MailController extends Controller
{
    // public function mail()
    // {
    //     $mailData = [
    //         'title'=>'Mail from devanshi',
    //         'body'=>'This email is for testing purpose',
    //     ];

    //     Mail::to('devanshibhavsar018@gmail.com')->send(new WelcomeMail($mailData));
    //     dd("emailsent successfully");
    // }
}
