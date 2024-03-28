<?php

namespace App\Livewire\Hospital;

use App\Models\Admin\Department;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use App\Models\Admin\Zone;
use Livewire\Component;

use function Livewire\Volt\layout;

class Register extends Component
{


   
    public $selectedregion=null;
    public $zones;
    public $name;
    public $phone;
    public $zone;
    public $woreda;
    public $country = 'ETHIOPIA';
    public $email;
    public $status = 0;
    public $type_id;
    public $region_id;
   public function updatedSelectedRegion($region_id){
   
$this->zones=Zone::where('region_id',$region_id)->get();
   }

    public function render()
    {
        $regions=Region::all();
        $types=Type::all();
        $departments=Department::all();

        return view('livewire.hospital.register',['regions'=>$regions,'types'=>$types,'departments'=>$departments]);
    }
}
