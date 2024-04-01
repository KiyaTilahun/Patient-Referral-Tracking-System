<?php

namespace App\Livewire\Hospital\Center;

use App\Models\Admin\Hospital;
use Livewire\Component;

class CenterTable extends Component
{


    public function show($id){
    
        $this->dispatch('hospital_selected', id: $id);
    
    }

    public function render()
    {

        $centers=Hospital::where('status','1') ->orderBy('name', 'asc')->paginate(5);

        return view('livewire.hospital.center.center-table',['centers'=>$centers]);
    }
}
