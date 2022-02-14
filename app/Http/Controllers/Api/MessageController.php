<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function index(Request $request){
        $client_id = $request->user()->id;

        $client = Client::where('id', $client_id)->first();
        $messages = null;
        if(isset($client) && $client!=null){
            $messages = $client->messages;
        }

        return response()->json(['messages' => $messages], 200);
    }

    public function create(Request $request){
        $Validated = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if($Validated->fails())
            return response()->json($Validated->messages());

        $message = new Message();
        $message->client_id = $request->user()->id;
        $message->message = $request->message;
        $message->action = 0;
        $message->status = 0;
        $message->save();

        return response()->json(['message' => $message], 200);
    }
    
}
