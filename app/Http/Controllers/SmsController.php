<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    //

    public function sms($phonenumbers, $messages,$hospitalname)
    {

        // dd($messages);
        $name = [];
        $phone = [];

        foreach ($phonenumbers as $key => $value) {
            $name[] = $key;
            $phone[] = $value;
        }





        $apiKey = env('SMS_API_KEY');
        $apiEndpoint = env('SMS_API_ENDPOINT');


        $phonearray = [];
        $phonearray = $phonenumbers;
        $failedphones = [];


        for ($i = 0; $i < count($name); $i++) {
            try {
               

                $response = Http::withHeaders([
                    'Authorization' => $apiKey, // Include the API key as a Bearer token
                ])->post($apiEndpoint, [
                    "to" => $phone[$i], // Example phone number
                    "message" =>$hospitalname."\n"."To ". $name[$i]." , ".$messages, 
                ]);
                // dd($response);
                // Check if the request was successful
                if ($response->successful()) {
                    // dd("true");
                 
                } else {
                   

                    $failedphones[] = $phone;
                  
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

        return [
            'success' => true,
            'message' => 'SMS sent successfully',
        ];


    }

public function changeappsms($phonenumber, $messages){
    $apiKey = env('SMS_API_KEY');
    $apiEndpoint = env('SMS_API_ENDPOINT');


   
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
                "to" => $phonenumber, // Example phone number
                "message" => $messages, // Example message
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
                

                return [
                    'success' => false,
                    'message' => 'Failed to send SMS',
                ];
              
            }
        } catch (\Exception $e) {
            // Handle errors during the request
            return [
                'success' => false,
                'message' => 'Error sending SMS: ' . $e->getMessage(),
            ];
        }  
}

    public function patientsms($name,$phonenumber, $messages)
    {



        $apiKey = env('SMS_API_KEY');
        $apiEndpoint = env('SMS_API_ENDPOINT');


       
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
                    "to" => $phonenumber, // Example phone number
                    "message" => "To " . $name .",This is are your login credentials ".$messages, // Example message
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
                    

                    return [
                        'success' => false,
                        'message' => 'Failed to send SMS',
                    ];
                  
                }
            } catch (\Exception $e) {
                // Handle errors during the request
                return [
                    'success' => false,
                    'message' => 'Error sending SMS: ' . $e->getMessage(),
                ];
            }
        
        //  dd($failedphones);




    }
}
