<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $patient = Patient::find($id);
        

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found',
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'patient' => $patient,
        ], HttpResponse::HTTP_OK);
    }
}
