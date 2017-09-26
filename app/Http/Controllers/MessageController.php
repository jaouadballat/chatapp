<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;

use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    
    public function fetch()
    {
    	return \App\Message::with('user')->get();
    }

    public function sentMessage()
    {
        $user = Auth::user();

    	$message = $user->messages()->create([
    		'message' => request()->message
    	]);

        broadcast(new MessageSentEvent($user, $message));

    }
}
