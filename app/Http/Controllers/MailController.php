<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendFooterMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $email = $request->email;
        $userMessage = $request->message;

        // Send the custom message from user input
        Mail::raw($userMessage, function ($message) use ($email) {
            $message->to($email)
                    ->subject('Message from Laravel App');
        });

        return back()->with('success', 'Mail sent successfully to ' . $email);
    }
}
