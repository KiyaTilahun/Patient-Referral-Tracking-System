<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\DepartmentHospital;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Mary\Traits\Toast;

class ReferralDetail extends Component
{
    use Toast;

    public $referral;
    public $card_number;
    public $date;
    public $route;
    public $alldays;
    public $selectedday;
    public $hospitalid;
    public $status;
    public $config1;
    public $selectedcenter;
    public $selecteddep;
    public $myDate1;
    public bool $appointmentmodal;
    public $updateddate;
public $type;

    public function mount($type,$card_number, $date)
    {
        $this->appointmentmodal = false;
        $this->type=$type;
        $this->card_number = $card_number;
        $this->date = $date;
        $this->status = [
            1 => "pending",
            2 => "completed",
        ];
        $this->route = url()->previous();
    }
    public function goBack()
    {
        return redirect($this->route);
    }

    public function openpdf($fileName)
    {


        $filePath = "Centers/{$fileName['file_path']}"; // Adjust the path based on your storage setup
        // dd($filePath);
        if (!Storage::disk('public')->exists($filePath)) {

            abort(404, 'File not found');
        }


        return Storage::download('public/' . $filePath);
    }


    public function changeAppointmentModal()
    {

        $this->selectedcenter = $this->referral->receiving_hospital_id;
        $this->selecteddep = $this->referral->department_id;
        //    dd($this->selecteddep);

        if ($this->selecteddep == null) {
            $this->warning('This is diagonal Referral ....');
            return;
        }


        $currentDate = Carbon::now()->addDays(1);
        $endDate = $currentDate->copy()->addDays(60);

        $getdep = DepartmentHospital::where('hospital_id', $this->selectedcenter)->where('department_id', $this->selecteddep)->first();

        $availableDays = DayDepartment::where('department_hospital_id', $getdep->id)
            ->where('hospital_id', $this->selectedcenter)
            ->pluck('day_id')
            ->toArray();

        $upcomingDates = [];

        while ($currentDate <= $endDate) {
            if (in_array($currentDate->dayOfWeekIso, $availableDays)) {
                $upcomingDates[] = $currentDate->format('Y/m/d');
            }
            $currentDate->addDay();
        }


        $slots = Appointmentslot::where('slotused', DB::raw('slotalotted'))
            ->where('availability', 'available')
            ->where('department_id', $this->selecteddep)
            ->where('hospital_id', $this->selectedcenter)
            ->pluck('date')
            ->unique()
            ->toArray();

        if (count($slots) > 0) {
            $upcomingDates = array_diff($upcomingDates, $slots);
        }





dd($upcomingDates);
        $this->config1 = $this->getConfig1($upcomingDates);
        // // dd($upcomingDates);
        // $this->appointmentmodal = true;
    }


    
    public function getConfig1($daysArray)
    {
        return [
            'dateFormat' => 'Y/m/d',
            'enableTime' => false,
            'enable' => $daysArray,
            'minDate' => "tomorrow",
            'maxDate' => Carbon::now()->addDays(70)->format('Y/m/d'),
            'theme' => 'material_dark'
        ];
    }


    public function updateappointment(){
        
       $this->validate([
            'updateddate' => 'required',
       
        ]);


    }
    // mounting referral 
    public function tonewreferral(){
        Session::put('referral_data', $this->referral);
        return redirect()->route('referral.add');
    }
    public function changeStatus($id)
    {

        $this->referral->update([
            'statustype_id' => $id
        ]);
        $this->render();
    }
    public function render()
    {

        $this->hospitalid = auth()->user()->hospital->id;

        if ($this->selectedday != null) {
            if($this->type==2){
            $this->referral = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->selectedday)->first();
           }
            else{
$this->referral = Referral::where('receiving_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->selectedday)->first();
            }
            $this->date=$this->selectedday;
           
        } else {
            if($this->type==2){
            $this->referral = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->date)->first();}
            else{
                $this->referral = Referral::where('receiving_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->where('referral_date', $this->date)->first(); 
            }
           
        }
        $this->alldays = Referral::where('referring_hospital_id', $this->hospitalid)->where('card_number', $this->card_number)->pluck('referral_date');

        $patient = $this->referral->patient;

        return view('livewire.patient.referral-detail', ['referral' => $this->referral], ['patient' => $patient], ['alldays' => $this->alldays]);
    }
}
