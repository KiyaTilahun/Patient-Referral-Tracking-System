<?php

namespace App\Livewire\Hospital\Inbound;

use App\Http\Controllers\SmsController;
use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class InboundDate extends Component
{
    use WithPagination, Toast;
    public $date;
    public $hospitalid;
    public $hospitalname;
    public array $sortBy = ['column' => 'referral_date', 'direction' => 'asc'];
    public $search;
    public $route;
    public $referral;
    public $department;
    public $avadepartments;
    public $cardnumbers;
    public $chooseddate;
    public $selectedcenter;
    public $selecteddep;
    public $config1;
    public $dephos;
    public $appcount;
    public $upcomingdate;
    public $updateddate;
    //    filtered centre
    public $filtered;
    public $updateappointment;
    public bool $appointmentmodal = false;



    public bool $myModal3 = false;
    public function mount($date)
    {
        $this->hospitalid = auth()->user()->hospital_id;
        // dd($this->hospitalid);
        $this->date = $date;
        $this->route = url()->previous();
    }

    public function goBack()
    {
        return redirect($this->route);
    }

    public function show($id)
    {
        // dd($id);

        $this->referral = Referral::where('id', $id)->with('patient')->first();

        $this->myModal3 = true;
    }
    // see patient in detail

    public function expand($referral)
    {

        // dd($referral['card_number']);
        return redirect()->route('hospital.referral', [
            'type'=>1,
            'card_number' => $referral['card_number'],
            'date' => $referral['referral_date']
        ]);
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
    // saving change
    public function appmassupdate()
    {

        $this->validate([
            'updateappointment' => 'required|date_format:Y-m-d',
        ]);

        $cardnumber = [];
        foreach ($this->filtered as $filter) {

            $cardnumber[] = $filter->card_number;
        }


        if (count($cardnumber) > 0) {
            $phones = Patient::whereIn('card_number', $cardnumber)->pluck('phone', 'name')->toArray();
            $hospitalname = $this->hospitalname;
           
            $changeapp=Appointmentslot::where('date',$this->date)->where('hospital_id',$this->hospitalid)->where('department_id',$this->department)->first();

            $changref=Referral::whereIn('card_number',$this->cardnumbers)->where('referral_date',$this->date)->where('department_id',$this->department)->get();
            // dd($this->updateappointment);   
            foreach($changref as $chan){
                $chan->update(['referral_date'=>$this->updateappointment]);
            }

            
            $changeapp->update(['slotused'=>$changeapp->slotalotted,'availability'=>'booked']);

            $changref=Referral::whereIn('referral_date',$this->cardnumbers)->get();
            // dd($changref);
            // dd($changeapp);
            // dd($message);    
            $sender = new SmsController();
            $message = "የነበሮት ቀጠሮ ከ" . $this->updateappointment . " ወደ " . $this->date . " ተቀይሯል::";

            //  $message="hellp";
              $checkresponse=$sender->sms($phones,$message);
                if($checkresponse){
                    // dd($checkresponse);
                    $this->success("SMS  sent to patients");
                    $this->appointmentmodal=false;

                }

                $this->render();
        }
        else{
            $this->error("some error happened");
        }
    }

    public function changeAppointmentModal()
    {

        // dd($this->dephos);
        $this->selectedcenter = $this->date;
        $this->selecteddep = $this->department;
        //    dd($this->selecteddep);

        if ($this->selecteddep == null) {
            $this->warning('This is diagonal Referral ....');
            return;
        }


        $currentDate = Carbon::now()->addDays(1);
        $endDate = $currentDate->copy()->addDays(60);

        $getdep = DepartmentHospital::where('hospital_id', $this->hospitalid)->where('department_id', $this->selecteddep)->first();
        // dd($getdep);

        $availableDays = DayDepartment::where('department_hospital_id', $getdep->id)
            ->where('hospital_id', $this->hospitalid)
            ->pluck('day_id')
            ->toArray();
        
        $upcomingDates = [];

        while ($currentDate <= $endDate) {
            if (in_array($currentDate->dayOfWeekIso, $availableDays)) {
                $upcomingDates[] = $currentDate->format('Y-m-d');
            }
            $currentDate->addDay();
        }
        

        $slots = Appointmentslot::whereRaw('slotalotted - slotused < ?', $this->appcount)
            ->where('availability', 'available')
            ->where('department_id', $this->selecteddep)
            ->where('hospital_id', $this->hospitalid)
            ->pluck('date')
            ->unique()
            ->toArray();
      

        if (count($slots) > 0) {
            $upcomingDates = array_diff($upcomingDates, $slots);
        }

        $this->config1 = $this->getConfig1($upcomingDates);
        $this->upcomingdate = $upcomingDates;
        $this->appointmentmodal = true;
    }

    public function getConfig1($daysArray)
    {
        return [
            'dateFormat' => 'Y-m-d',
            'enableTime' => false,
            'enable' => $daysArray,
            'minDate' => "tomorrow",
            'maxDate' => Carbon::now()->addDays(70)->format('Y-m-d'),
            'theme' => 'material_dark'
        ];
    }
    public function render()
    {
        $hospital = auth()->user()->hospital;

        $this->hospitalname = $hospital->name;
        // dd($this->hospitalid);
        $centers = Referral::where('receiving_hospital_id', $this->hospitalid)->where('referral_date', $this->date)->when($this->search, function ($query) {
            $query->where('card_number', 'LIKE', '%' . $this->search . '%');
        })->when($this->department, function ($query) {
            $query->where('department_id', $this->department);
        })->withAggregate('department', 'id')->withAggregate('referringHospital', 'name')->withAggregate('statustype', 'name')->withAggregate('referrtype', 'name')->withAggregate('patient', 'name')->orderBy(...array_values($this->sortBy))->paginate(20);
        if ($this->department == null) {
            $departments = $centers->pluck('department_id')->unique()->values()->all();
            $cardnumbers = $centers->pluck('card_number')->unique()->values()->all();
// dd($cardnumbers);
$this->cardnumbers=$cardnumbers;
            $this->avadepartments = Department::whereIn('id', $departments)->get();
        }
        //   dd($this->avadepartments);
        $this->appcount = count($centers);
        $this->filtered = $centers->all();
        // dd($this->appcount);
        // $this->dephos=$centers;
        $headers = [
            ['key' => 'card_number', 'label' => 'Referral Id'],
            ['key' => 'referring_hospital_name', 'label' => 'Referral To'],
            ['key' => 'patient_name', 'label' => 'Patient Name'],
            ['key' => 'referrtype_name', 'label' => 'Type'],
            ['key' => 'statustype_name', 'label' => 'Status'],       # <-- nested attributes

        ];

        return view('livewire.hospital.inbound.inbound-date', [
            'centers' => $centers, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
