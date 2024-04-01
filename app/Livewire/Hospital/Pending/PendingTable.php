<?php

namespace App\Livewire\Hospital\Pending;

use App\Models\Admin\Hospital;
use Illuminate\Contracts\Session\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PendingTable extends Component
{
use WithPagination;
  


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
        $pendings=Hospital::where('status','0') ->orderBy('name', 'asc')->paginate(5);
        return view('livewire.hospital.pending.pending-table',['pendings'=>$pendings]);
    }
}
