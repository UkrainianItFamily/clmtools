<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends ApiController
{
    public function all()
    {
        $messages = Message::all();

        return response()->json($messages);
    }
}
