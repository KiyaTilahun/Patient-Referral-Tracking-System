<?php

namespace App\Livewire\Utils;

use App\Models\Admin\Hospital;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    
    
    public function render()
    {
        $pending=Hospital::where('registered','0')->get();
        return view('livewire.utils.sidebar',['pending'=>$pending]);
    }
}
