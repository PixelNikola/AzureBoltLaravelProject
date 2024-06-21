<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormEmail;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to('nikivuk3@gmail.com')->send(new ContactFormEmail($validateData));

        return redirect('/')->with('message', 'Email sent successfully!');
    }
}
