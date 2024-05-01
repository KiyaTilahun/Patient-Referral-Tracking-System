<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    //
   
    public function sms($phonenumbers,$messages){

        $name=[];
        $phone=[];

        foreach($phonenumbers as $key=>$value){
            $name[]=$key;
            $phone[]=$value;
                     }
        // dd($name);
//         $basic  = new \Vonage\Client\Credentials\Basic("9670a0ae", "vqoak6G8DCgCIzMi");
// $client = new \Vonage\Client($basic);


// $response = $client->sms()->send(
//     new \Vonage\SMS\Message\SMS("251943072433", "Appointment", 'A text message sent using the Nexmo SMS API')
// );

// $message = $response->current();

// if ($message->getStatus() == 0) {
//     echo "The message was sent successfully\n";
// } else {
//     echo "The message failed with status: " . $message->getStatus() . "\n";
// }




$apiKey = env('SMS_API_KEY');
$apiEndpoint = env('SMS_API_ENDPOINT');

// Prepare the data to be sent in the POST request
// $formData = [
//     'to' => "+251943072433",
//     'message' => "hello",
// ];

 $phonearray=[];
 $phonearray=$phonenumbers;
$failedphones=[];


for ($i = 0; $i < count($name); $i++) {
    try {
        // Send the POST request with authorization header
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $apiKey,
        // ])->post($apiEndpoint, $formData);
    // dd($apiEndpoint);
    
// dd($phone[$i]);
    
    $response = Http::withHeaders([
        'Authorization' => $apiKey, // Include the API key as a Bearer token
    ])->post($apiEndpoint, [
        "to" => $phone[$i], // Example phone number
        "message" => "To ".$name[$i]." , ".$messages, // Example message
    ]);
    // dd($response);
        // Check if the request was successful
        if ($response->successful()) {
            // dd("true");
            return [
                'success' => true,
                'message' => 'SMS sent successfully',
            ];


        
        } else {
            dd("false");

            $failedphones[]=$phone;
            return [
                'success' => false,
                'message' => 'Failed to send SMS',
            ];
            continue;
        }
    } catch (\Exception $e) {
        // Handle errors during the request
        return [
            'success' => false,
            'message' => 'Error sending SMS: ' . $e->getMessage(),
        ];
    }
 }
//  dd($failedphones);




}
 
}
