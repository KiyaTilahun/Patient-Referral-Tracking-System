<div>
  <x-mary-toast />

    @if (!is_null($detail))
  <div class="flex justify-between">     <span
    class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500  dark:text-gray-400">
    <span
        class="mb-4 text-lg font-extrabold leading-none tracking-tight text-gray-900 md:text-lg dark:text-white">User details</span>  </span>
        @if (!(auth()->user()->hasRole('superadmin')))
    <x-mary-button label="Edit User" wire:click="edituser" icon="c-pencil-square"  />   @endif
  </div>
 


<div class="grid grid-cols-12  ">



   

    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Name:</span>  {{$detail->name}}
        </x-checkmark></div>
        
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Center:</span>  {{$detail->hospital->name}}
        </x-checkmark></div>
  
    <div class="p-4 col-span-12 md:col-span-12 "> <x-checkmark class="text-xl"><span class="text-green-500 dark:text-green-400">Email:</span> <a href="mailto:{{$detail->email}}">  {{$detail->email}}</a>
        </x-checkmark></div>
      
      
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Role:</span> @foreach ($detail->roles as $role)
          <span class="inline-flex self-end justify-center px-2 border-success  dark:border-warning border-[1px] ms-3 text-xs font-medium text-success bg-gray-200 rounded dark:bg-gray-700 dark:text-warning">
            {{ Str::upper($role['name']) }}
          </span>
        @endforeach
      </x-checkmark> 
    </div>
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>  <x-mary-button label="Delete User" icon="o-trash" wire:click="try_delete({{ $detail->id }})" spinner class="btn-sm text-error" />
        </x-checkmark> 
      </div>



        <x-mary-modal wire:model="myModal1" class="backdrop-blur">

          <form wire:submit.prevent="roleupdate">
              <div class="flex items-center justify-between p-2 ">
                

                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      @click="$wire.myModal1 = false">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
  
                  </button>
              </div>
  
              <div class="mt-4">
  


                  @if ($myModal1)
                      <x-mary-input placeholder="Permission" icon="o-shield-check" hint="use small letters"
                          wire:model='updatename' class="placeholder:text-warning" disabled />

                          <span
                          class=" mt-4 inline-flex items-center justify-center px-2 py-0.5 ms-3 text-l font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400  ">
                          All &nbsp;<span class="text-warning"> User </span> &nbsp; roles </span>
                      <div class="">
                          
                          <div class="grid">
                              @foreach ($allroles as $rol)
                                  <x-mary-checkbox label="{{ $rol }}" wire:model="role"
                                      class="checkbox-warning mt-2" value="{{ $rol}}" omit-error />
                              @endforeach
                          </div>
                      </div>
                  @endif
              </div>
              @error('role')
                              <div class="px-2 ms-3 text-sm text-red-800 rounded-lg  dark:bg-gray-800 dark:text-red-600"
                                  role="alert">
                                  <span class="font-medium">{{ $message }}</span>
                              </div>
                          @enderror
              <div class="text-right"> <x-mary-button label="Update" class="btn btn-outline btn-primary" type="submit" />
              </div>
          </form>
      </x-mary-modal>
       
       
        
 
      
@else
<div class="flex justify-between">   <span
  class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500  dark:text-gray-400">
  <span
      class="mb-4 text-lg font-extrabold leading-none tracking-tight text-gray-900 md:text-lg dark:text-white">User details</span>  </span>
      @if (!(auth()->user()->hasRole('superadmin')))
    <x-mary-button label="Edit User"  icon="c-pencil-square" disabled />@endif</div>
    
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Name:
        </x-checkmark></div>
        
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Center:
        </x-checkmark></div>
  
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Email:
        </x-checkmark></div>
        <div class="p-4 col-span-12 md:col-span-6"> <x-checkmark>Role:
        </x-checkmark></div>
        @endif
</div>
</div>


<script>

window.addEventListener('deletedialog',function(e){
    Swal.fire({
  icon: "warning",
  title : 'Are you sure to Delete User? ',
  showCancelButton: true,
text:"Will be saved if you choose OK!",
  confirmButtonColor: "#d33",
  cancelButtonColor: "#00ca92",
  confirmButtonText: "Yes, Delete User!"
}).then((result) => {
  if (result.isConfirmed) {
    @this.dispatch('godelete');
    Swal.fire({
      title: "Deleted!",
      text: "Centered  has been activated.",
      icon: "warning"
    });
  }
 
 
});
        });

    
</script>
