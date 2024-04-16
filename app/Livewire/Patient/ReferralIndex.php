<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
use App\Models\DayDepartment;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReferralIndex extends Component
{
    use WithFileUploads;
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
    public $availbledep;
    public $availablecenter;
    public $typeinitial;
    public $config1;
    public $hosid;

    // routing
    public $route;

    public function mount()
    {

        $this->route = url()->previous();
        $this->hosid = auth()->user()->hospital_id;
        $this->currentStep ;
        $this->doctors = Doctor::where('hospital_id', $this->hosid)->get();
        $typeinitial = Hospital::where('id', $this->hosid)->first();
        $this->typeinitial = $typeinitial->type_id;
        // dd($this->typeinitial);



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
                'doctor' => 'required|string',




            ];
        } else {
            if ($this->referral_type != 3) {
                return [
                    'referral_type'=>'required',
                    'fileattach' => 'mimes:pdf|max:2048',
                    'selectedcenter' => 'required',
                    'selecteddep' => 'required',
                    'appday' => 'date_format:Y/m/d',


                ];
            } else {
                return [
                    'referral_type'=>'required',
                    'fileattach' => 'mimes:pdf|max:2048',
                    'selectedcenter' => 'required',
                    'appday' => 'date_format:Y/m/d',
                ];
            }
        }
    }

    // when a user selects referral type
    public function updatedReferralType()
    {
        $this->reset('notdiagonal');
        $this->reset('selecteddep');

        if ($this->referral_type != '3') {

            $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();

            $this->notdiagonal = true;
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
        } else {
            $initial = Patient::where('card_number', $this->card_number)->first();
            $this->initial = $initial->hospital;
        }
    }
    // when department is choosen
    public function updatedSelecteddep()
    {

        $this->reset('availablecenter');
        // dd($this->selecteddep);
        $avail = $this->selecteddep;
        $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();
        if ($this->referral_type == '1') {

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


        $slots = AppointmentSlot::where('slotused', DB::raw('slotalotted'))
            ->where('availability', 'available')
            ->where('department_id', $this->selecteddep)
            ->where('hospital_id', $this->selectedcenter)
            ->pluck('date')
            ->unique()
            ->toArray();
        // dd($slots);
        if (count($slots) > 0) {
            $upcomingDates = array_diff($upcomingDates, $slots);
        }

        // sort($upcomingDates);
        // $upcomingDates = array_diff($upcomingDates, $slots);




        $this->config1 = $this->getConfig1($upcomingDates);
        // dd($upcomingDates);

    }

    
    public function updatedcardNumber(){
        // dd("hello");
        $this->name = Patient::where('card_number', $this->card_number)->value('name');
       
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





    public function register(){
    
            $this->secondvalidation = $this->validate();
        dd($this->fileattach);
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
