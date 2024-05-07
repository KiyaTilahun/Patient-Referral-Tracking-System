<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\Admin\HospitalService;
use App\Models\Admin\Referrtype;
use App\Models\Admin\Type;
use App\Models\DayDepartment;
use App\Models\Referral\Referral;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;

class ReferralIndex extends Component
{
    use WithFileUploads, Toast;


    public $gender;
    public $card_number;
    public $name;
    public $history;
    public $finding;
    public $treatment;
    public $reason;
    public $doctor;
    public $selecteddep;
    public $selectedcenter;
    public $doctor_id;
    public $validated;
    public $doctors;
    public $fileattach;
    public $appday;
    public $secondvalidation;
    public $totalSteps = 2;
    public $currentStep = 1;
    #[Url]
    public $search = '';
    public bool $notdiagonal = false;
    public $referral_type;
    public $initial;
    public $hospitalname;
    public $referralname = "";
    public $referredcenter = "";
    public $availbledep;
    public $availablecenter;
    public $typeinitial;
    public $config1;
    public $hosid;
    public $initialhospital;
    // modal
    public bool $myModal3 = false;
    public bool $help = false;
    public bool $saved = false;
    public $config;
    // routing
    public $route;
    public $mounted_referral;


    // service
    public $departmentServices;

    public function mount()
    {
        $this->config = ['mode' => 'range'];
       
        $this->mounted_referral = Session::get('referral_data');
        Session::remove('referral_data');
        if($this->mounted_referral!=null){
            // dd($this->mounted_referral->doctor_id);
            $this->card_number=$this->mounted_referral->card_number;
           $this->name=$this->mounted_referral->patient->name;
           $this->history=$this->mounted_referral->history;
            $this->finding=$this->mounted_referral->findings;
            $this->treatment=$this->mounted_referral->treatment;
           $this->reason=$this->mounted_referral->reason;
           $this->doctor=$this->mounted_referral->doctor_id??null;

        }
        $this->route = url()->previous();
        $this->hosid = auth()->user()->hospital_id;
        $this->currentStep;
        $this->doctors = Doctor::where('hospital_id', $this->hosid)->get();
        $typeinitial = Hospital::where('id', $this->hosid)->first();
        $this->hospitalname = $typeinitial->name;
        $this->typeinitial = $typeinitial->type_id;
        // dd($this->typeinitial);



    }

    public function newreferral()
    {

        return redirect()->route('referral.add');
    }

    public function helpmodal()
    {

        $this->help = !$this->help;
    }
    public function goBack()
    {
        return redirect($this->route);
    }
    public function updated($name)
    {
        $this->resetValidation();
    }
    public function increaseStep()
    {
        $this->resetErrorBag();

        if ($this->currentStep == 1) {
            $this->validated = $this->validate();
        }
        $this->resetValidation();
        // $this->reset();
        $this->currentStep++;

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }
    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function rules()
    {


        if ($this->currentStep == 1) {
            return [
                'card_number' => 'string|exists:patients',
                'name' => 'required|string',
                'history' => 'required|string',
                'finding' => 'required|string',
                'treatment' => 'required|string',
                'reason' => 'required|string',
                'doctor' => 'required',




            ];
        } else {
            if ($this->referral_type != 3) {
                return [
                    'referral_type' => 'required',
                    'fileattach' => 'max:10240',
                    'selectedcenter' => 'required',
                    'selecteddep' => 'required',
                    'appday' => 'date_format:Y/m/d',


                ];
            } else {
                return [
                    'referral_type' => 'required',
                    'fileattach' => 'max:10240',
                    'selectedcenter' => 'required',
                    'appday' => 'date_format:Y/m/d',
                    'selecteddep' => '',


                    // 'initial'=>'required'

                ];
            }
        }
    }

    // when a user selects referral type
    public function updatedReferralType()
    {
        $this->reset('referralname');
        // $this->reset('notdiagonal');
        $this->reset('appday');
        $this->reset('selecteddep');
        $this->reset('selectedcenter');
        $this->reset('initial');
        $this->reset('departmentServices');





        $this->referralname = Referrtype::where('id', $this->referral_type)->value('name');
        if ($this->referral_type != '3') {
            $hospital = Hospital::where('id', auth()->user()->hospital->id)->first();

            // $this->notdiagonal = true;
            if ($this->referral_type == '2') {

                $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                    $query->where('region_id', $hospital->region_id)
                        ->where('hospitals.id', '!=', $hospital->id)
                        ->where('type_id', $hospital->type_id);
                })->get();
            }

            if ($this->referral_type == '1') {
                if ($hospital->type_id == 1) {
                    $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                        $query->where('region_id', $hospital->region_id)
                            ->where('hospitals.id', '!=', $hospital->id)
                            ->where('type_id', '>', $hospital->type_id)
                            ->where('type_id', '<=', 3);
                    })->with('hospitals')->get();
                } else {
                    $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                        $query
                            ->where('type_id', '>', $hospital->type_id)
                            ->where('hospitals.id', '!=', $hospital->id)
                            ->where('type_id', '<=', 3);
                    })->get();
                }
            }

            // if($this->availbledep==null){
            //     $this->warning('No departments for referrals found');

            // }

            $this->notdiagonal = true;

            if (count($this->availbledep) <= 0) {
                $this->warning('No Department is found');
            }
        } else {
            $initial = Patient::where('card_number', $this->card_number)->first();
            $this->initial = $initial->hospital;
            $this->notdiagonal = false;

            // $this->selectedcenter=$initial->hospital->id;

        }
    }
    // when department is choosen
    public function updatedSelecteddep()
    {
        $this->reset('departmentServices');
        $this->reset('availablecenter');
        $this->reset('selectedcenter');

        // dd($this->selecteddep);
        $avail = $this->selecteddep;
        $hospital = Hospital::where('id', auth()->user()->hospital->id)->first();
        if ($this->referral_type == '1') {
            $this->notdiagonal = true;
            if ($hospital->type_id == '2') {
                $hospitalsWithDepartment = Hospital::where('type_id', 3)->where('hospitals.id', '!=', $hospital->id)
                    ->whereHas('departments', function ($query) use ($avail) {
                        $query->where('department_id', $avail);
                    })
                    ->get();
                $this->availablecenter = $hospitalsWithDepartment;
            }
            // if ($hospital->type_id == '1') {
            else {
                $hospitalsWithDepartment = Hospital::where('type_id', 2)->where('hospitals.id', '!=', $hospital->id)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {
                        $query->where('department_id', $avail)
                            ->where('region_id', $hospital->region_id);
                    })
                    ->get();

                $this->availablecenter = $hospitalsWithDepartment;
            }
        }

        if ($this->referral_type == '2') {

            if ($hospital->type_id == '2') {
                $hospitalsWithDepartment = Hospital::where('type_id', 2)->where('hospitals.id', '!=', $hospital->id)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {

                        $query->where('department_id', $avail)
                            ->where('region_id', $hospital->region_id);
                    })
                    ->get();
                $this->availablecenter = $hospitalsWithDepartment;
            } elseif ($hospital->type_id == '3') {

                $hospitalsWithDepartment = Hospital::where('type_id', 3)->where('hospitals.id', '!=', $hospital->id)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {
                        $query->where('department_id', $avail);
                    })
                    ->get();

                $this->availablecenter = $hospitalsWithDepartment;
            } else {
                $hospitalsWithDepartment = Hospital::where('type_id', 1)->where('hospitals.id', '!=', $hospital->id)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {
                        $query->where('department_id', $avail)
                            ->where('region_id', $hospital->region_id);
                    })
                    ->get();

                $this->availablecenter = $hospitalsWithDepartment;
            }
        }
    }


    // when center is choosen
    public function updatedSelectedcenter()
    {

        // day maker
        $this->reset('appday');
        $this->reset('referredcenter');
        

        $this->referredcenter = Hospital::where('id', $this->selectedcenter)->value('name');

        $this->departmentServices=HospitalService::where('hospital_id',$this->selectedcenter)->where('department_id',$this->selecteddep)->get();
        // dd($this->departmentServices);




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


        $slots = AppointmentSlot::where('availability', 'booked')
            ->where('department_id', $this->selecteddep)
            ->where('hospital_id', $this->selectedcenter)
            ->pluck('date')
            ->unique()
            ->toArray();

            
        $daydiff=[];
        if ($slots) {
            $slots = array_map(function ($date) {
                return Carbon::parse($date)->format('Y/m/d');
            }, $slots);
            $upcomingDates = array_diff($upcomingDates,$slots);
            $daydiff = array_values($upcomingDates);
            // dd($daydiff);
        }
        else{
            $daydiff=$upcomingDates;
        }
      

        
        // sort($upcomingDates);
        // $upcomingDates = array_diff($upcomingDates, $slots);




        $this->config1 = $this->getConfig1($daydiff);
        // dd($upcomingDates);

    }


    public function updatedcardNumber()
    {
        // dd("hello");
        $name = Patient::where('card_number', $this->card_number)->first();
        $this->name = $name;

        // dd($this->name);  
    }

    #[On('card_choosed')]
    public function updatename($card_number)
    {

        $this->card_number = Patient::where('card_number', $card_number)->value('card_number');
        $this->name = Patient::where('card_number', $this->card_number)->value('name');
    }


    public function fillSearchInput($value)
    {

        $this->card_number = $value;
        $this->dispatch('card_choosed', card_number: $value);
    }




    // generator
    // public function generatepdf()
    // {

    // }

    // calendar configuration
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





    public function register()
    {




        if ($this->referral_type != 3) {
            // dd("hello");
            $hospital = Hospital::findOrFail($this->secondvalidation['selectedcenter']);

            // dd($slotalotted);
            // dd($slotalotted);
            $slot = AppointmentSlot::where('department_id', $this->secondvalidation['selecteddep'])
                ->where('hospital_id', $this->secondvalidation['selectedcenter'])
                ->where('date', $this->secondvalidation['appday'])
                ->first();


            
            if (!$slot) {
                // dd("hello");
                $slotalot = $hospital->departments()->where('department_id', $this->secondvalidation['selecteddep'])->firstOrFail()->pivot->slot;


                $slot = AppointmentSlot::create([
                    'department_id' => $this->secondvalidation['selecteddep'],
                    'hospital_id' => $this->secondvalidation['selectedcenter'],
                    'date' => $this->secondvalidation['appday'],
                    'slotalotted' => $slotalot,
                    'slotused' => 1,

                ]);
                
            } else {
                if ($slot->slotused >= $slot->slotalotted) {
                    $this->myModal3 = false;
                    
                    $this->error('On '.$this->secondvalidation['appday']. ' is fully booked try another Date',''. $slot->slotalotted.'/'.$slot->slotalotted. ' slots are used', icon: 'o-calendar',);
                    $this->reset('selectedcenter');
                    return;
                } else {
             
                    $slot->increment('slotused');

                    if ($slot->slotused >= $slot->slotalotted) {
                        $slot->update(['availability' => 'booked']);
                    }
                }
            }
        }

        if ($this->fileattach != null) {
            $hospitalname = Hospital::where('id', $this->secondvalidation['selectedcenter'])->first()->name;
            $hospitalname = str_replace(' ', '_', $hospitalname);
            $extension = "pdf";
            $name = $hospitalname . '/' . $this->card_number . '_' . now()->format('Ymd') . '.' . $extension;

            $this->fileattach->storeAs('Centers/', $name, 'public');
            // dd($this->fileattach);
            $this->secondvalidation['fileattach'] = $name;
            // $this->secondvalidation['fileattach']->storeAs('Centers/', $name, 'public');
            // $this->secondvalidation['fileattach'] = $name;
        }

        // dd($this->fileattach);

        $referral = Referral::create([
            'card_number' => $this->validated['card_number'],
            'referral_date' => $this->secondvalidation['appday'],
            'referring_hospital_id' => $this->hosid,
            'receiving_hospital_id' => $this->secondvalidation['selectedcenter'],
            'referrtype_id' => $this->secondvalidation['referral_type'],
            'department_id' => $this->secondvalidation['selecteddep'],
            'doctor_id' => $this->validated['doctor'],
            'history' => $this->validated['history'],
            'findings' => $this->validated['finding'],
            'treatment' => $this->validated['treatment'],
            'reason' => $this->validated['reason'],
            'file_path' => $this->secondvalidation['fileattach'],
        ]);
        // dd("successful");
        $this->myModal3 = false;
        $this->saved = true;
    }


    public function checkentry()
    {
        if ($this->referral_type == 3) {
            $this->selectedcenter = $this->initial->id;
            $this->appday = now()->format('Y/m/d');
        }
        $this->secondvalidation = $this->validate();
        $this->myModal3 = true;
    }
    public function generatepdf()
    {



        return redirect()->route('generate', ['id' => $this->card_number]);
    }
    public function render()
    {
        $results = [];
        // dd($results);

        if (strlen($this->card_number) > 0) {

            $results = Patient::where('card_number', 'like', '%' . $this->card_number . '%')->pluck('card_number');
        }

        return view('livewire.patient.referral-index', compact('results'));
    }
}
