<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Department;
use App\Models\Admin\DepartmentService;
use App\Models\Admin\Service;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Departmentlist extends Component
{
    use WithPagination, Toast;



    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $search;
    public $updatedepartment;
    public $selecteddep;
    public $newdepartment;
    public $newservice;
    public $route;
    public bool $myModal2 = false;
    public bool $modal17 = false;
    public bool $serviceModal = false;
    public bool $newservicemodal=false;


    public bool $updatebutton = false;
    public $allservices;
    public $myservices;
    public $selecteddepservices = [];

    public function mount()
    {

        $this->route = url()->previous();
        
    }
    public function goBack()
    {
        return redirect($this->route);
    }
    public function updatedSelecteddepservices()
    {

        $this->updatebutton = true;
    }
    public function updated($newdepartment)
    {
        $this->resetErrorBag();
    }
    public function edit($id)
    {
        $this->reset('selecteddep');
        $this->selecteddep = Department::where('id', $id)->first();

        if ($this->selecteddep != null) {
            $this->updatedepartment = $this->selecteddep->name;
            $this->myModal2 = true;
        }
        // dd($this->selecteddep);
    }

    public function attachservice($id)
    {
        $this->allservices = Service::all();
$this->reset('selecteddepservices');
        $this->reset('selecteddep');
        $this->selecteddep = Department::where('id', $id)->first();
        $selecteddepservices = DepartmentService::where('department_id', $this->selecteddep->id)->get();
        $this->myservices = $selecteddepservices;
        foreach ($selecteddepservices as $selected) {

            $this->selecteddepservices[] = $selected->service_id;
        }

        if ($this->selecteddep != null) {
            $this->updatedepartment = $this->selecteddep->name;
            $this->serviceModal = true;
        }
        // dd($this->selecteddep);
    }

    // new dep
    public function savemodal()
    {

        $this->modal17 = true;
    }
    public function saveservice()
    {

        $this->newservicemodal = true;
    }



    public function departmentupdate(){
        $this->validate(
            [

                'selecteddepservices' => 'required'
            ]
        );
        $this->selecteddep->services()->detach();
        $this->selecteddep->services()->attach($this->selecteddepservices);
        $this->warning('Department '.$this->selecteddep->name.'services have been updated');
        $this->serviceModal=false;
        // $this->attachservice($this->selecteddep->id);
    }
    public function addnew()
    {

        $this->validate([
            'newdepartment' => 'required|unique:departments,name|string|max:255',
        ]);

        $slot = Department::create(['name' => $this->newdepartment]);
        // dd($slot);
        $this->modal17 = false;
        $this->warning($this->newdepartment . ' department is added to Departments');
        $this->reset('newdepartment');
        $this->render();
    }
    public function addnewservice()
    {

        $this->validate([
            'newservice' => 'required|unique:services,name|string|max:255',
        ]);

        $slot = Service::create(['name' => $this->newservice]);
        // dd($slot);
        $this->newservicemodal = false;
        $this->warning($this->newservice . ' Service is added to Services table');
        $this->reset('newservice');
        // $this->reset();
        $this->render();
    }

    #[On('gosave')]
    public function updatedep()
    {

        $this->selecteddep->name = $this->updatedepartment;

        $this->selecteddep->save();

        $this->myModal2 = false;
    }


    public function try_update()
    {
        $this->validate([
            'updatedepartment' => 'required|string|max:255',
        ]);
        $this->dispatch('swal_update', []);
    }
    public function render()
    {

        $departments = Department::orderBy('name', 'asc')
            ->when($this->search, function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->search . '%');
            })->paginate(10);
            // dd($departments);
        //    dd(count($departments));
        // dd($departments);

        // dd($this->departments);
        $headers = [
            ['key' => 'id', 'label' => 'Id'],
            ['key' => 'name', 'label' => 'Department Name'],
        ];
        return view('livewire.admin.departmentlist', [
            'departments' => $departments, 'headers' => $headers,
            'sortBy' => $this->sortBy
        ]);
    }
}
