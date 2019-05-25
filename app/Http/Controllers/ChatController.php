<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\ChatEvent;
use App\User;

use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function chat(){
    	return view('chat');
    }

    /*public function send(Request $request)
    {
        $user = User::find(Auth::id());
        $this->saveToSession($request);
        event(new ChatEvent($request->message,$user));
        //return $request->all();
    }*/
    /* public function send(){
    	$message = 'hello';
    	$user = User::find(Auth::id());
    	event(new ChatEvent($message,$user));

    } */

    /*public function saveToSession(Request $request){

        session()->put('chat',$request->message);

    }*/
    public function send(request $request)
    {
        $user = User::find(Auth::id());
        $this->saveToSession($request);
        event(new ChatEvent($request->message,$user));
    }
    public function saveToSession(request $request)
    {
        session()->put('chat',$request->chat);
    }

    public function getOldMessage()
    {
        return session('chat');
    }
    public function deleteSession()
    {
        session()->forget('chat');
    }

}
