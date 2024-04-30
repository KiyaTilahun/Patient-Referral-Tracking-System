<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Department;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Departmentlist extends Component
{
    use WithPagination,Toast;



    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $search;
    public $updatedepartment;
    public $selecteddep;
    public $newdepartment;
    public $route;
    public bool $myModal2=false;
    public bool $modal17=false;

    public function mount()
    {
        
        $this->route = url()->previous();
    }
    public function goBack()
{
    return redirect($this->route);
}
public function updated($newdepartment)
    {
        $this->resetErrorBag();
    }
    public function edit($id)
    {
        $this->reset('selecteddep');
        $this->selecteddep = Department::where('id', $id)->first();
        
        if($this->selecteddep!=null){
            $this->updatedepartment=$this->selecteddep->name;
            $this->myModal2=true;
        }
        // dd($this->selecteddep);
    }

// new dep
public function savemodal(){

    $this->modal17=true;
}


public function addnew(){
   
    $this->validate([
        'newdepartment' => 'required|unique:departments,name|string|max:255', 
    ]);

    $slot = Department::create(['name' => $this->newdepartment]);
    // dd($slot);
$this->modal17=false;
    $this->warning($this->newdepartment.' department is added to Departments');
    $this->reset('newdepartment');
    $this->render();



}

    #[On('gosave')]
    public function updatedep()
    {

        $this->selecteddep->name = $this->updatedepartment;

        $this->selecteddep->save();

        $this->myModal2=false;
    
    
 
    
   
      

    }


    public function try_update(){
        $this->validate([
            'updatedepartment' => 'required|string|max:255', 
        ]);
        $this->dispatch('swal_update', [
            
        ]);
        
    }
    public function render()
    {

        $departments = Department::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->get();
        // dd($departments);

        // dd($this->departments);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Department Name'],
        ];
        return view('livewire.admin.departmentlist', [
            'departments' => $departments, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
