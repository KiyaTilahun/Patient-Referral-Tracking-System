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
    <x-mary-table :headers="$headers" :rows="$departments" :sort-by="$sortBy" >
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

        <x-mary-modal wire:model="serviceModal" class="backdrop-blur">
            <form wire:submit.prevent="try_update">
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
                        Department</span>


                    @isset($selecteddep)
                    <div class="mt-4">
                        <x-mary-input placeholder="Your name" icon="o-shield-check" wire:model='updatedepartment'
                            autofocus />
                    </div>
                    <select class="select select-primary " wire:model.live='selectedregion'>
                        <option selected class="text-sm pt-0 mt-0" value="{{null}}">All Regions</option>
                        @foreach ($allservices as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                    <div class="text-right mt-4"> <x-mary-button label="Update" class="btn btn-outline btn-primary"
                            type="submit" />
                    </div> 
                    @endisset 
                       
                   
                </div>
                    
            </form>

        </x-mary-modal>
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
