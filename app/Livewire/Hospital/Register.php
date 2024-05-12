<?php

namespace App\Livewire\Hospital;

use App\Models\Admin\Department;
use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Users\Liaison;
use Illuminate\Support\Str;

use App\Models\Admin\Type;
use App\Models\Admin\Zone;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

use function Livewire\Volt\layout;

#[Layout('layouts.app')]
class Register extends Component
{

    use WithFileUploads;

    public $selectedregion = null;
    public $zones;
    public $name;

    public $phone;
    public $zone;
    public $woreda;
    public $country = 'ETHIOPIA';
    public $email;
    public $status = 0;
    public $type;
    public $departmentlist = [];
    public $file;

    public $phone_number;
    public $liaison_officer;
    public $liaisonemail;

    public $validated;
    public $liasionvalidation;


    public $registeredEmail;





    // step form
    public $totalSteps = 3;
    public $currentStep = 1;


    public function placeholder()
    {
        return view('utils.spinner');
    }
    public function mount()
    {
        $this->currentStep = 1;
        $this->registeredEmail;
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
        } else {
            $this->liasionvalidation = $this->validate();
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
                'name' => 'required|unique:hospitals,name',
                'selectedregion' => 'required|string',
                'email' => 'required|unique:hospitals,email',
                'phone' => 'required|min:9|numeric',
                'zone' => 'required',
                'selectedregion' => 'required',
                'type' => 'required',
                'file' => 'required|mimes:pdf|max:2048',


            ];
        } else {
            return [
                'phone_number' => 'required|min:9|numeric',
                'liaison_officer' => 'required|string',


            ];
        }
    }

    public function register()
    {
        // ...
        // $this->validate();

        $extension = $this->validated['file']->getClientOriginalExtension();
        $namereplace = str_replace(' ', '_', $this->validated['name']);
        $name = $namereplace . '_' . now()->format('Ymd') . '.' . $extension;

        $this->validated['file']->storeAs('admin/register', $name, 'public');

        // dd($name);
        $this->validated['file'] = $name;


        $this->registeredEmail = $this->validated['email'];

        $hospital = Hospital::create([


            'name' =>   Str::of(Str::replace(' ', '_', $this->validated['name']))->upper(),
            'region_id' => $this->validated['selectedregion'],
            'filename' => $this->validated['file'],
            'email' => $this->validated['email'],
            'phone' => '+251' . $this->validated['phone'],
            'zone' => $this->validated['zone'],
            'type_id' => $this->validated['type'],
        ]);





        $this->currentStep = 4;
        session()->flash('status', 'Registration was  successfully check your email for approval.');
    }
    public function logout()
    {
        $this->redirect('/login');
    }
    public function updatedSelectedRegion($region_id)
    {

        $this->zones = Zone::where('region_id', $region_id)->get();
    }







    public function render()
    {
        $regions = Region::all();
        // dd($regions);
        $types = Type::all();
        $departments = Department::all();

        return view('livewire.hospital.register', ['regions' => $regions, 'types' => $types, 'departments' => $departments]);
    }
}
