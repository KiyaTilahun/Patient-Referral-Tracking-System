<div>
    <x-mary-toast />

    <div class="flex justify-between mb-4 ">
        {{-- <x-mary-button label="Go Back" link="/patient/add" icon="o-arrow-left" />
         --}}
        <x-mary-button label="Go Back" wire:click="goBack" icon="o-arrow-left" />


        <div class="px-4">
         


            <div class="text-right">
                <span>

                    <x-mary-button icon="s-plus-circle" label="New Department" class="text-green-500 btn-warning btn-outline hover:bg-none"
                        wire:click='savemodal' spinner />
                </span>
                <span>

                    <x-mary-button icon="s-plus-circle" label="New Service" class="text-green-500 btn-info btn-outline hover:bg-none"
                        wire:click='saveservice' spinner />
                </span>
            </div>
        </div>
    </div>
    <x-mary-header title="Departments" subtitle="Search centers">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" class="border-green-500 focus:border-green-500"
                wire:model.live='search' placeholder="Search..." />
        </x-slot:middle>




    </x-mary-header>

    {{-- <div>{{$departments}}</div> --}}
    <x-mary-table :headers="$headers" :rows="$departments" :sort-by="$sortBy" with-pagination>
        @scope('actions', $department)
            <span class="flex gap-4">

                <x-mary-button icon="s-pencil-square" wire:click="edit({{ $department->id }})" spinner
                    class="btn-sm text-success" />
                <x-mary-button icon="o-trash" wire:click="delete({{ $department->id }})" spinner
                    class="btn-sm text-error" />
                    <x-mary-button icon="c-cog" wire:click="attachservice({{ $department->id }})" spinner
                        class="btn-sm text-warning" />
            </span>
        @endscope

        </x-table>



        <x-mary-modal wire:model="myModal2" class="backdrop-blur">
            <form wire:submit.prevent="try_update">
                <div class="flex items-center justify-end p-2 ">

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$wire.myModal2 = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>

                    </button>
                </div>
                <div class="flex flex-col ">
                    <span class=" cursor-default w-fit">Edit
                        Department</span>


                    @isset($selecteddep)
                    <div class="mt-4">
                        <x-mary-input placeholder="Your name" icon="o-shield-check" wire:model='updatedepartment'
                            autofocus />
                    </div>
                    <div class="text-right mt-4"> <x-mary-button label="Update" class="btn btn-outline btn-primary"
                            type="submit" />
                    </div> 
                    @endisset 
                       
                   
                </div>
                    
            </form>

        </x-mary-modal>
        @isset($myservices)
        <x-mary-modal wire:model="serviceModal" class="backdrop-blur">
            <div class="h-[80vh]">
            <form wire:submit.prevent="departmentupdate">
                <div class="flex items-center justify-end p-2 ">

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$wire.serviceModal = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>

                    </button>
                </div>
                <div class="flex flex-col ">
                    <span class=" cursor-default w-fit">Edit
                        Department Services</span>


                    @isset($selecteddep)
                    <div class="mt-4">
                        <x-mary-input placeholder="Your name" icon="o-shield-check" wire:model='updatedepartment'
                            autofocus  disabled/>
                    </div>
                    <div class="mt-4">
                        
                    <select class="select select-success " >
                        <option selected class="text-sm pt-0 mt-0" value="{{null}}">Department services</option>
                        @foreach ($myservices as $service)
                            <option >{{$service->service->name}}</option>
                        @endforeach
                    </select>

                   
                    </div>
                    <div class="text-right mt-4">
                        

                        @if ($updatebutton)
                        <x-mary-button label="Update" class="btn btn-outline btn-primary"
                        type="submit" />
                        @error('selecteddepservices')
                        <div class="px-2 mr-4 mt-4 mb-4 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600 w-full"
                            role="alert">
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    @enderror
                        @else
                        <x-mary-button label="Update" class="btn btn-outline btn-primary"
                        type="submit" disabled />
                    @endif
                        
                        
                     
                    </div> 

                    <div class="h-[30vh] overflow-y-auto" >
                        @foreach ($allservices as $service)
                        <x-mary-checkbox label="{{ $service->name}}" wire:model.live="selecteddepservices"
                            class="checkbox-warning my-2" value="{{ $service->id }}" omit-error />
                    @endforeach
                    </div>
                    @endisset 
                       
                   
                </div>
                    
            </form>
            </div>
        </x-mary-modal>
        @endisset
{{-- new department --}}

        <x-mary-modal wire:model="modal17" class="backdrop-blur">
            <form wire:submit.prevent="addnew">
                <div class="flex items-center justify-end p-2 ">

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$wire.modal17 = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>

                    </button>
                </div>
                <div class="flex flex-col ">
                    <span class=" cursor-default w-fit">New
                        Department</span>


                
                    <div class="mt-4">
                        <x-mary-input placeholder="Department name" icon="o-shield-check" wire:model.live='newdepartment'
                            autofocus />
                    </div>
                    <div class="text-right mt-4"> <x-mary-button label="Add" class="btn btn-outline btn-primary"
                            type="submit" />
                    </div> 
                  
                       
                   
                </div>
                    
            </form>

        </x-mary-modal>

        <x-mary-modal wire:model="newservicemodal" class="backdrop-blur">
            <form wire:submit.prevent="addnewservice">
                <div class="flex items-center justify-end p-2 ">

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="$wire.newservicemodal = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>

                    </button>
                </div>
                <div class="flex flex-col ">
                    <span class=" cursor-default w-fit">New
                        Service</span>


                
                    <div class="mt-4">
                        <x-mary-input placeholder="Service name" icon="o-shield-check" wire:model.live='newservice'
                            autofocus />
                    </div>
                    <div class="text-right mt-4"> <x-mary-button label="Add" class="btn btn-outline btn-primary"
                            type="submit" />
                    </div> 
                  
                       
                   
                </div>
                    
            </form>

        </x-mary-modal>


</div>
<script>
     window.addEventListener('swal_update',function(e){
    Swal.fire({
  icon: "warning",
  title : 'Are you sure to Update Department Name? ',
  showCancelButton: true,
text:"Will be saved if you choose OK!",
  confirmButtonColor: "#00ca92",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Update it!"
}).then((result) => {
  if (result.isConfirmed) {
    @this.dispatch('gosave');
    Swal.fire({
      title: "Updated!",
      text: "Department updated successfully",
      icon: "success"
    });
  }
 
 
});
        });
</script>
