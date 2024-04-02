<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailController extends Controller
{
  public function sendmail($center){


    $password=Str::random(10);
    // dd(now());
   $user=User::create(
    ['name'=>$center->name,'email'=>$center->email,'email_verified_at'=> now(),'hospital_id'=>$center->id,'password'=>Hash::make($password)]
   )->assignRole('admin');
   
   $response=Mail::to($user->email)->send(new RegisterEmail($user->name,$password));
   dd($response);

  }

  public function sendmaildoctor($doctor){


    $password=Str::random(10);
    // dd(now());
   $user=User::create(
    ['name'=>$doctor->name,'email'=>$doctor->email,'email_verified_at'=> now(),'hospital_id'=>$doctor->hospital_id,'password'=>Hash::make($password)]
   )->assignRole('doctor');
   
   $response=Mail::to($user->email)->send(new RegisterEmail($user->email,$password));
   dd($response);

  }
}
