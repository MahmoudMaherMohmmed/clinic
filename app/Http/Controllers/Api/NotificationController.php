<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{

    public function index(Request $request){
        $client_id = $request->user()->id;

        $client = Client::where('id', $client_id)->first();
        $notifications = [];
        if(isset($client) && $client!=null){
            $notifications = $this->formatNotifications($client->notifications);
        }

        return response()->json(['notifications' => $notifications], 200);
    }

    private function formatNotifications($notifications){
        $notifications_array = [];

        foreach($notifications as $notification){
            array_push($notifications_array, [
                'id' => $notification->id,
                'title' => $notification->title,
                'body' => $notification->body,
                'created_at' => $notification->created_at->isToday() ? $notification->created_at->format('H:1 A') : $notification->created_at->format('d M'),
            ]);
        }

        return $notifications_array;
    }

    public function delete(Request $request){
        $Validated = Validator::make($request->all(), [
            'notification_id' => 'required'
        ]);

        if($Validated->fails())
            return response()->json($Validated->messages(), 403);

        $client_id = $request->user()->id;
        $notification = Notification::where('id', $request->notification_id)->where('client_id', $client_id)->first();
        if(isset($notification) && $notification!=null){
            $notification->delete();
            return response()->json(['message' => 'notification deleted successfully.'], 200);
        }

        return response()->json(['message' => 'notification is not found.'], 403); 
    }
    
}
