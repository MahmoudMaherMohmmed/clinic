<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function send($device_token)
    {
        return $this->sendNotification($device_token, array(
          "title" => "Title", 
          "body" => "Hello World"
        ));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification($device_token, $message)
    {
        $SERVER_API_KEY = 'AAAAlmTViqc:APA91bG811HA-kSO8zGXgcHFzYNDjzwo-NvU6AjS7p1oKyEW6EoZ14kEZYXAERPqvGscBYv2nZ1-gEnZIbqM7vxiCk49VswSlHpZaiR-EwdnkdRlnsi_HfxhoUWyxvA8H7wPqauPv7F9';
  
        // payload data, it will vary according to requirement
        $data = [
            "to" => $device_token, // for single device id
            "notification" => $message
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);

        curl_close ( $ch );

        return $response;
    }
}