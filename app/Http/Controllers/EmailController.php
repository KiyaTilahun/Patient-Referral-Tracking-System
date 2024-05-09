<?php

namespace App\Http\Controllers;

use App\Mail\PatientEmail;
use App\Mail\RegisterEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mary\Traits\Toast;

class EmailController extends Controller
{
  
  public function sendmail($center){


    $password=Str::random(10);
    // dd(now());
   $user=User::create(
    ['name'=>$center->name,'email'=>$center->email,'email_verified_at'=> now(),'hospital_id'=>$center->id,'password'=>Hash::make($password)]
   )->assignRole('admin');
   
   $response=Mail::to($user->email)->send(new RegisterEmail($user->name,$password));
  //  dd($response);

  }

  public function sendmaildoctor($doctor){


    $password=Str::random(10);
    // dd(now());
   $user=User::create(
    ['name'=>$doctor->name,'email'=>$doctor->email,'email_verified_at'=> now(),'hospital_id'=>$doctor->hospital_id,'password'=>Hash::make($password)]
   )->assignRole('doctor');
   
   
  //  dd($response);


  try {
        
    Mail::to($user->email)->send(new RegisterEmail($user->email,$password));
    return true;

 

} catch (\Exception $e) {

    // Return a failure response
    return false;
  
    // $this->error("Error, Email is not sent");

}

  }

  public function sendpatientmail($card_number,$token,$email){

    $jsonData = json_encode([
      "referral_id"=>$card_number,
      "token"=>$token,
  ]);
  try {
    Mail::to($email)->send(new PatientEmail($card_number, $token, $jsonData));

    return [
        'status' => 'success',
        'message' => 'Email sent successfully'
    ];
} catch (\Exception $e) {
 

    return [
        'status' => 'error',
        'message' => 'Failed to send email'
    ];
}
  }
}
