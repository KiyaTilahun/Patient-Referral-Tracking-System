<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Appointmentslot;
use App\Models\Admin\DepartmentHospital;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferralController extends Controller
{
  public function index($card,$date){
  
    $referral = Referral::where('referral_date',$date)->where('card_number',$card)->first();
        

    if (!$referral) {
        return response()->json([
            'message' => 'Referral not found',
        ], Response::HTTP_NOT_FOUND);
    }

    return response()->json([
        'referral' => $referral,
    ], Response::HTTP_OK);
}

public function apirefer(){
    return response()->json([
        'referral' => "hello",
    ], Response::HTTP_OK);
}
public function change($card,$date,$department,$hospital){


    $currentDate = Carbon::now()->addDays(1);
    $endDate = $currentDate->copy()->addDays(60);
    $getdep = DepartmentHospital::where('hospital_id', $hospital)->where('department_id', $department)->first();
    
    if (!$getdep) {
        return response()->json([
            'message' => 'Referral not found',
        ], Response::HTTP_NOT_FOUND);
    }
else{
    $availableDays = DayDepartment::where('department_hospital_id', $getdep->id)
    ->where('hospital_id', $hospital)
    ->pluck('day_id')
    ->toArray();

    $upcomingDates = [];

        while ($currentDate <= $endDate) {
            if (in_array($currentDate->dayOfWeekIso, $availableDays)) {
                $upcomingDates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }
        

        $slots = Appointmentslot::whereRaw('slotalotted - slotused < ?', 1)
            ->where('availability', 'available')
            ->where('department_id', $department)
            ->where('hospital_id', $hospital)
            ->pluck('date')
            ->unique()
            ->toArray();
      

        if (count($slots) > 0) {
            $upcomingDates = array_diff($upcomingDates, $slots);
        }

}

    return response()->json([
        'days' => $upcomingDates,
    ], Response::HTTP_OK);
}
}
