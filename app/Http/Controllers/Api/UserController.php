<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralResource;
use App\Models\User;
use App\Models\Users\Patient;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class UserController extends Controller
{
    //

    public function index($id)
    {
        // Find the patient by ID
        $patient = Patient::where('card_number',$id)->first();

        
        

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found',
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        $patientData = [
            'Full Name' => $patient->name,
            'Referral Id' => $patient->card_number,
            'Phone Number' => $patient->phone,
            'Gender' => $patient->gender->name,
            'Email' => $patient->email,
            'Registering Center' => $patient->hospital->name,
           
        ];
        // $patient->load(['referrals.referringHospital', 'referrals.receivingHospital']);
        // $referrals=$patient->referrals;
        $referrals=ReferralResource::collection($patient->referrals);
        return response()->json([
            'patient' => $patientData,
            'referrals'=>$referrals
        ], HttpResponse::HTTP_OK);
    }
}
