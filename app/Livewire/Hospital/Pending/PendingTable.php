<?php

namespace App\Livewire\Hospital\Pending;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use App\Models\Admin\Type;
use Illuminate\Contracts\Session\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PendingTable extends Component
{
use WithPagination;
public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
public $search;
public $selectedregion;
public $selectedtype;
public $allregions;
public $alltypes;

  

public function mount(){
    $this->allregions=Region::all();
    $this->alltypes=Type::all();
}

public function show($id){
    
    $this->dispatch('hospital_selected', id: $id);

}
 

#[On('reset_table')]
public function reset_table()
{

     $this->reset();
    $this->render();

}


    public function render()
    {

        // $pendings=Hospital::where('registered','0') ->orderBy('name', 'asc')->paginate(5);
        $pendings=Hospital::where('registered','0')->when($this->search, function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })->when($this->selectedregion, function ($query) {
            $query->where('region_id',$this->selectedregion);
        })->when($this->selectedtype, function ($query) {
            $query->where('type_id',$this->selectedtype);
        })->withAggregate('region','name')->orderBy(...array_values($this->sortBy))->paginate(5);
     

        $headers = [
            
            ['key' => 'name', 'label' => 'Center Name'],
            ['key' => 'region_name', 'label' => 'Region Name'],
            ['key' => 'registered', 'label' => 'Registered'],      # <-- nested attributes
      
        ];
        return view('livewire.hospital.pending.pending-table',['pendings'=>$pendings,'headers'=>$headers,
        'sortBy'=> $this->sortBy]);
    }
}
