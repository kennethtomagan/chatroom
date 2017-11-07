<?php

namespace App\Http\Controllers\Chat;

use App\Events\Chat\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Message;
use App\Http\Requests\Chat\StoreMessageRequest;
class ChatMessageController extends Controller
{

    public function index()
    {
    	$message = Message::with(['user'])->latest()->limit(100)->get();
    	return response()->json($message, 200); 	
    }

    public function store(StoreMessageRequest $request)
    {
    	$message = $request->user()->messages()->create([
    		'body'=> $request->body
    	]);
        broadcast(new MessageCreated($message))->toOthers();
    	return response()->json($message, 200); 	

    }
}
