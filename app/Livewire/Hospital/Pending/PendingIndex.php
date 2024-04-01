<?php

namespace App\Livewire\Hospital\Pending;

use App\Models\Admin\Hospital;
use Livewire\Attributes\On;
use Livewire\Component;

class PendingIndex extends Component
{

   
    #[On(['hospital_approved'])]
    public function reload($name)
    {
        $this->reset();
         
   
        $this->dispatch('reset_detail');
        $this->dispatch('reset_table');

        $this->render();
        
       
    }

    #[On(['deleted'])]
    public function reloaddelete(){
        $this->reset();
         
   
        $this->dispatch('reset_detail');
        $this->dispatch('reset_table');

        $this->render();
    }





    public function render()
    {

        $pendingcount=Hospital::where('status','0') ->orderBy('name', 'asc')->get();
     
        return view('livewire.hospital.pending.pending-index',['pendingcount'=>$pendingcount]);
    }
}
