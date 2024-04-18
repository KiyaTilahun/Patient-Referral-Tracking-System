<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\DepartmentHospital;
use App\Models\Admin\Hospital;
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

class ReferralIndex extends Component
{
    use WithFileUploads,Toast;


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
    public $initialhospital;

    // routing
    public $route;

    public function mount()
    {

        $this->route = url()->previous();
        $this->hosid = auth()->user()->hospital_id;
        $this->currentStep;
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
                'doctor' => 'required',




            ];
        } else {
            if ($this->referral_type != 3) {
                return [
                    'referral_type' => 'required',
                    'fileattach' => 'max:10,240',
                    'selectedcenter' => 'required',
                    'selecteddep' => 'required',
                    'appday' => 'date_format:Y/m/d',


                ];
            } else {
                return [
                    'referral_type' => 'required',
                    'fileattach' => 'max:10,240',
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

            // if($this->availbledep==null){
            //     $this->warning('No departments for referrals found');
                
            // }
        } else {
            $initial = Patient::where('card_number', $this->card_number)->first();
            $this->initial = $initial->hospital;
            // $this->selectedcenter=$initial->hospital->id;

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
        $this->reset('appday');

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

        // dd($this->selectedcenter);
        if ($this->referral_type == 3) {
            $this->selectedcenter = $this->initial->id;
            $this->appday=now()->format('Y/m/d');

        }
        $this->secondvalidation = $this->validate();


        if ($this->referral_type != 3) {
            $hospital = Hospital::findOrFail($this->secondvalidation['selectedcenter']);
           
            // dd($slotalotted);
            // dd($slotalotted);
            $slot = AppointmentSlot::where('department_id', $this->secondvalidation['selecteddep'])
                ->where('hospital_id', $this->secondvalidation['selectedcenter'])
                ->where('date', $this->secondvalidation['appday'])
                ->first();


            // dd($slot);
            if (!$slot) {
                $slotalotted = $hospital->departments()->where('department_id', $this->secondvalidation['selecteddep'])->firstOrFail()->pivot->slot;

                $slot = AppointmentSlot::create([
                    'department_id' => $this->secondvalidation['selecteddep'],
                    'hospital_id' => $this->secondvalidation['selectedcenter'],
                    'date' => $this->secondvalidation['appday'],
                    'slotalotted' => 1,
                    'slotused' => 1,

                ]);
                // dd($slot);
            } else {
                if($slot['availability']=='booked'){

                    $this->warning($this->secondvalidation['appday']. '  is fully booked try another Date');
                    return;

                }
                $slot->increment('slotused');

                if ($slot->slotused >= $slot->slotalotted) {
                    $slot->update(['availability' => 'booked']);
                }
            }
        }

        if ($this->fileattach != null) {
            $hospitalname = Hospital::where('id', $this->secondvalidation['selectedcenter'])->first()->name;
            $hospitalname = str_replace(' ', '_', $hospitalname);
            $extension = $this->secondvalidation['fileattach']->getClientOriginalExtension();
            $name = $this->card_number . '_' . now()->format('Ymd') . '.' . $extension;

            $this->secondvalidation['fileattach']->storeAs('Centers/' . $hospitalname, $name, 'public');
            $this->secondvalidation['fileattach'] = $name;
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
        dd("successful");

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
