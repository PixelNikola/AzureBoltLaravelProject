<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function create(Request $request){
        $loggedUser = auth()->id();
        $receiver = $request->input('receiverId');
        $user = User::findOrFail($receiver);
        $first_name = $user->first_name;
        $messages = Message::where(function ($query) use ($loggedUser, $receiver) {
            $query->where('sender_id', $loggedUser)
                  ->where('receiver_id', $receiver);
        })->orWhere(function ($query) use ($loggedUser, $receiver) {
            $query->where('sender_id', $receiver)
                  ->where('receiver_id', $loggedUser);
        })->get();

     
        return view('chat', compact('messages', 'user', 'first_name'));
    }

    

    public function store(Request $request)
    {
          // Receive the request data
          $senderId = auth()->user()->id;
          $receiverId = $request->input('receiverId');

          $messageContent = $request->input('message');
  
          // Create a new message instance
          $message = new Message();
          $message->sender_id = $senderId;
          $message->receiver_id = $receiverId;
          $message->message= $messageContent;
  
          // Save the message to the database
          $message->save();
          return redirect()->back();
    }

    public function displayReceiver(Request $request){

        $receiver = $request->input('receiverId');
        $user = User::findOrFail($receiver);
        
        return view('chat', compact('firstName', 'user'));
    }

    public function displayMessages(Request $request){
        $user = auth()->id();
        $receiver = $request->input('receiverId');
        $user = User::findOrFail($receiver);
        $messages = Message::where(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $user)
                  ->where('receiver_id', $receiver);
        })->orWhere(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $receiver)
                  ->where('receiver_id', $user);
        })->get();

        return view('chat');
    }
}
