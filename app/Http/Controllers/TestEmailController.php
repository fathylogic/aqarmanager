<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function send(Request $request)
    {
        $to = $request->query('email');
        $subject = $request->query('subject');
        $message = $request->query('message');

        if (!empty($to) && !empty($subject) && !empty($message)) {

            Mail::raw($message, function ($msg) use ($to, $subject) {
                $msg->to($to)
                    ->subject($subject);
            });

            return response('Mail sent successfully', 200);
        }

        return response('Mail not sent, Please try again later', 400);
    }
}
