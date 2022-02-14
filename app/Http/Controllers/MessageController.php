<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = [];
        $clients_id = Message::orderBy('created_at', 'DESC')->get()->unique('client_id');
        if(isset($clients_id) && $clients_id!=null){
            foreach($clients_id as $client){
                array_push($clients, [
                    'client_id' => $client->client->id,
                    'client_name' => $client->client->name,
                    'client_image' => $client->client->image,
                    'message' => $client->message,
                    'date' => $client->created_at->format('d M')
                ]);
            }
        }

        return view('message.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->user_id = Auth::id();
        $message->client_id = $request->client_id;
        $message->message = $request->message;
        $message->action = 1;
        $message->save();

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function clientMessages($client_id){
        $messages = Message::where('client_id', $client_id)->get();

        $client_messages_html = view('partial.client_messages', compact('messages'))->render();

        return $client_messages_html;
    }
}
