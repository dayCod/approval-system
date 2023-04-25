<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class Email
{
    public static function send($to, $title, $view, $data = null)
    {
        Mail::send($view, $data, function($message) use($to, $title) {
            $message->to($to)->subject($title);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
        });
    }
}
