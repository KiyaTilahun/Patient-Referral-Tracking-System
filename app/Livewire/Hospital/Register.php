<?php

namespace App\Livewire\Hospital;

use App\Models\Admin\Department;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\Admin\Zone;
use Livewire\Component;
use Livewire\Attributes\Validate;

use function Livewire\Volt\layout;

class Register extends Component
{



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
    public $region;
   public $liaisonname;
   public $phoneonname;





    // step form
    public $totalSteps = 3;
    public $currentStep = 1;


    public function placeholder()
    {
        return view('utils.spinner');
    }
    public function mount(){
        $this->currentStep = 1;
    }

    public function increaseStep(){
        $this->resetErrorBag();
        // dd("hello");
        $validated=$this->validate();
        $this->reset();
    $this->currentStep++;
   

         if($this->currentStep > $this->totalSteps){
             $this->currentStep = $this->totalSteps;
         }
    }
    public function decreaseStep(){
        $this->resetErrorBag();
        $this->currentStep--;
        if($this->currentStep < 1){
            $this->currentStep = 1;
        }
    }

    public function rules() 
    {

       
          
            return[
               'name'=>'required|unique:hospitals',
                'selectedregion'=>'required|string',
                'email'=>'required|unique:hospitals',
                'phone'=>'required',
                'selectedregion'=>'required',
                'woreda'=>'required|numeric',
                'type'=>'required'
          
          ];
        
       
        

    }

    public function register()
    {
        // ...
 
        session()->flash('status', 'Registration was  successfully check your email for approval.');
 
        $this->redirect('/login');
    }
    public function updatedSelectedRegion($region_id)
    {

        $this->zones = Zone::where('region_id', $region_id)->get();
    }







    public function render()
    {
        $regions = Region::all();
        $types = Type::all();
        $departments = Department::all();

        return view('livewire.hospital.register', ['regions' => $regions, 'types' => $types, 'departments' => $departments]);
    }
}
