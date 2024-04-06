<?php

namespace App\Livewire;

use App\Models\Admin\Hospital;
use App\Models\Admin\Region;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Dashboard extends Component
{
 
    public $tablenames=['hospitals','users'];
   public $selectedtable;
   public $selectedcolumn;

   public $columns=[];
   public $columnvalues=[];
    public function mount(){
    $this->tablenames;
    }


    public function updatedSelectedTable($table_name)
    {

        // if($table_name=='hospitals'){
      

        // }
        $columns = Schema::getColumnListing($table_name);
        $filteredColumns = array_filter($columns, function ($column) {
            return !in_array($column, ['created_at', 'updated_at','remember_token','id','phone','country','filename','email','password','email_verified_at']);
        });
        $this->columns=$filteredColumns;
        if($table_name=='users'){
            $this->columns[]='type';
        }
        
    }

    public function updatedSelectedColumn($col_name)
    {

        if($col_name=='region_id'){
      $this->columnvalues=Region::all();

        }
        else{

if($this->selectedtable=='hospitals'){


    $this->columnvalues = Hospital::distinct()->pluck($col_name);
    // dd($this->columnvalues);
}
        }
        // $columns = Schema::getColumnListing($table_name);
        // $filteredColumns = array_filter($columns, function ($column) {
        //     return !in_array($column, ['created_at', 'updated_at']);
        // });
        // $this->columns=$filteredColumns;
        
    }
    public function render()
    {

        
        return view('livewire.dashboard');
    }
}
