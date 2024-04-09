<?php

namespace App\Livewire\Patient;

use App\Models\Admin\Appointmentslot;
use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Users\Doctor;
use App\Models\Users\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReferralIndex extends Component
{
    public $gender;
    public $card_number;
    public $name;
    public $history;
    public $finding;
    public $treatment;
    public $reason;
    public $doctor;
    public $selecteddep;
    public $doctor_id;
    public $validated;
    public $doctors;
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

    public function mount()
    {
        $id = auth()->user()->hospital_id;
        $this->currentStep = 1;
        $this->doctors = Doctor::where('hospital_id', $id)->get();
        $typeinitial = Hospital::where('id', $id)->first();
        $this->typeinitial = $typeinitial->type_id;
        // dd($this->typeinitial);


        // day maker
        $slots = Appointmentslot::where('slotused', '=', DB::raw('slotalotted'))
            ->where('availability', '=', 'available')
            ->get();

        $daysArray = [];
        foreach ($slots as $slot) {
            $date = $slot->date;
            if (!in_array($date, $daysArray)) {
                $daysArray[] = $date;
            }
        }
        for ($i = 0; $i < 5; $i++) {

            $nextSunday = Carbon::now()->addWeeks($i)->next(Carbon::SUNDAY)->format('Y/m/d');

            $daysArray[] = $nextSunday;
        }

        $this->config1 = $this->getConfig1($daysArray);
    }

    public function increaseStep()
    {
        $this->resetErrorBag();

        if ($this->currentStep == 1) {
            $this->validated = $this->validate();
        } else {
            $this->secondvalidation = $this->validate();
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
            return [
                'phone_number' => 'required|unique:liaisons|min:9|numeric',
                'liaison_officer' => 'required|string',


            ];
        }
    }
    public function updatedReferralType()
    {
        $this->reset('notdiagonal');
        if ($this->referral_type != '3') {

            $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();

            $this->notdiagonal = true;
            if ($this->referral_type == '2') {

                $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                    $query->where('region_id', $hospital->region_id)
                        ->where('type_id', $hospital->type_id);
                })->get();
            }

            if ($this->referral_type == '1') {
                if ($hospital->type_id == 1) {
                    $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                        $query->where('region_id', $hospital->region_id)
                            ->where('type_id', '>', $hospital->type_id)
                            ->where('type_id', '<=', 3);
                    })->with('hospitals')->get();
                } else {
                    $this->availbledep =  Department::whereHas('hospitals', function ($query) use ($hospital) {
                        $query
                            ->where('type_id', '>', $hospital->type_id)
                            ->where('type_id', '<=', 3);
                    })->get();
                }
            }
        } else {
            $initial = Patient::where('card_number', $this->card_number)->first();
            $this->initial = $initial->hospital;
        }
    }
    public function updatedSelecteddep()
    {

        $this->reset('availablecenter');
        $avail = $this->selecteddep;
        $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();
        if ($this->referral_type == '1') {

            if ($hospital->type_id == '2') {
                $hospitalsWithDepartment = Hospital::where('type_id', 3)
                    ->whereHas('departments', function ($query) use ($avail) {
                        $query->where('department_id', $avail);
                    })
                    ->get();
                $this->availablecenter = $hospitalsWithDepartment;
            }
            // if ($hospital->type_id == '1') {
                else{
                $hospitalsWithDepartment = Hospital::where('type_id', 2)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {
                        $query->where('department_id', $avail->department_id)
                            ->where('region_id', $hospital->region_id);
                    })
                    ->get();

                $this->availablecenter = $hospitalsWithDepartment;
            }
        }

        if ($this->referral_type == '2') {

            if ($hospital->type_id == '2') {
                $hospitalsWithDepartment = Hospital::where('type_id', 2)
                    ->whereHas('departments', function ($query) use ($avail,$hospital) {

                        $query->where('department_id', $avail)
                        ->where('region_id', $hospital->region_id);
                    })
                    ->get();
                $this->availablecenter = $hospitalsWithDepartment;
            }
            elseif ($hospital->type_id == '1') {
                
                $hospitalsWithDepartment = Hospital::where('type_id', 3)
                    ->whereHas('departments', function ($query) use ($avail, $hospital) {
                        $query->where('department_id', $avail->department_id);
            
                    })
                    ->get();

                $this->availablecenter = $hospitalsWithDepartment;
            }
            else{
                $hospitalsWithDepartment = Hospital::where('type_id', 1)
                ->whereHas('departments', function ($query) use ($avail, $hospital) {
                    $query->where('department_id', $avail->department_id)
                    ->where('region_id', $hospital->region_id);
        
                })
                ->get();

            $this->availablecenter = $hospitalsWithDepartment;
            }
        }
    }

    #[On('card_choosed')]
    public function updatename($card_number)
    {


        $this->name = Patient::where('card_number', $card_number)->value('name');
    }


    public function fillSearchInput($value)
    {

        $this->card_number = $value;
        $this->dispatch('card_choosed', card_number: $value);
    }




    // generator
    public function generatepdf()
    {
        $hospital = Hospital::where('id', auth()->user()->hospital_id)->first();

        $availbledep =  Department::all()->toArray();

        $qr = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $day = now()->format('d/m/Y');
        $pdf =  PDF::loadView('utils.generatepdf', compact('availbledep', 'qr', 'day'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'name.pdf');
    }

    // calendar configuration
    public function getConfig1($daysArray)
    {
        return [
            'dateFormat' => 'Y/m/d',
            'enableTime' => false,
            'disable' => $daysArray,
            'minDate' => "today",
            'maxDate' => Carbon::now()->addDays(30)->format('Y/m/d'),
            'theme' => 'material_dark'
        ];
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
