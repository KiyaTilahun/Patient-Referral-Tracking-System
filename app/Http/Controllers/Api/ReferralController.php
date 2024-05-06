<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferDetail;
use App\Models\Admin\Appointmentslot;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use function Pest\Laravel\json;

class ReferralController extends Controller
{
    public function index($card, $date)
    {

        $referral = Referral::where('referral_date', $date)->where('card_number', $card)->first();


        if (!$referral) {
            return response()->json([
                'message' => 'Referral not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'referral' => $referral,
        ], Response::HTTP_OK);
    }

    public function apirefer()
    {
        return response()->json([
            'referral' => "hello",
        ], Response::HTTP_OK);
    }


    public function change($card, $date)
    {
        $referral = Referral::where('card_number', $card)->where('referral_date', $date)->first();
        $hospital = $referral->receiving_hospital_id;
        $department = $referral->department_id;

        $currentDate = Carbon::now()->addDays(1);
        $endDate = $currentDate->copy()->addDays(60);
        $getdep = DepartmentHospital::where('hospital_id', $hospital)->where('department_id', $department)->first();

        if (!$getdep) {
            return response()->json([
                'message' => 'Referral not found',
            ], Response::HTTP_NOT_FOUND);
        } else {
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



    // specific referral 
    public function show($card, $id)
    {
        $referral = Referral::where('card_number', $card)->where('id', $id)->get();




        if (!$referral) {
            return response()->json([
                'message' => 'Patient not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $detail = ReferDetail::collection($referral);
        return response()->json([

            'detail' => $detail
        ], Response::HTTP_OK);
    }


    public function update($card,$date,Request $request){

        $validated = $request->validate([
            'changedate' => [
                'required',
                'date', 
                'regex:/^\d{4}-\d{2}-\d{2}$/',
            ],
        ]);
        // return response()->json([
        //     'status' => 'success',
        //     'validated' => $validated,
        // ]);
        $referral = Referral::where('card_number', $card)->where('referral_date', $date)->first();
        // return response()->json([
        //     $referral
        // ]);
        $hospital = $referral->receiving_hospital_id;
        $department = $referral->department_id;
     
        $myhosp=Hospital::where('id',$hospital)->first();
        $slot = AppointmentSlot::where('department_id', $department)
        ->where('hospital_id', $hospital)
        ->where('date', $validated['changedate'])
        ->first();


    
    if (!$slot) {
        // dd("hello");
        $slotalot = $myhosp->departments()->where('department_id', $department)->firstOrFail()->pivot->slot;


        $slot = AppointmentSlot::create([
            'department_id' => $department,
            'hospital_id' => $hospital,
            'date' => $validated['changedate'],
            'slotalotted' => $slotalot,
            'slotused' => 1,

        ]);
        
    } else {
        if ($slot->slotused >= $slot->slotalotted) {
            
          return  response()->json([
                'status' => 'Error',
                'validated' => "The date is full choose another day",
            ]);
        } else {
     
            $slot->increment('slotused');

            if ($slot->slotused >= $slot->slotalotted) {
                $slot->update(['availability' => 'booked']);
            }
        }
    }

    $referral->update(['referral_date'=>$validated['changedate']]);
   
        $slots = Appointmentslot
                ::where('department_id', $department)
                ->where('hospital_id', $hospital)->where('date', $date)->first();
        

        if($slots->slotalotted == $slots->slotused){

            $slots->decrement('slotused');
            $slots->update(["availablity=>available"]);
        }
        else{
            $slots->decrement('slotused');
        }

        if($slots->slotused==0){
            $slots->delete();
        }

        return  response()->json([
            'status' => 'Success',
            'validated' => "The appointment date has been changed from ".$date." to ".$validated['changedate'],
        ]);




    }
}
