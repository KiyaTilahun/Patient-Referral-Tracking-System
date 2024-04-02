<?php

namespace App\Livewire\Hospital\Center;

use Livewire\Attributes\On;
use Livewire\Component;

class CenterIndex extends Component
{

    #[On('resetdetail')]
    public function reload()
    {


       $this->reset();
       $this->render();
    
    }
    


    

    public function render()
    {
        return view('livewire.hospital.center.center-index');
    }
}
