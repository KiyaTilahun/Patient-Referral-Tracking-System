<div class="grid grid-cols-12  ">


    
    @if (!is_null($detail))
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Name:</span>  {{$detail->name}}
        </x-checkmark></div>
        
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Adress:</span>  Ethiopia,{{$detail->region->name}},{{$detail->zone}},woreda-{{$detail->woreda}}
        </x-checkmark></div>
  
    <div class="p-4 col-span-12 md:col-span-12 "> <x-checkmark class="text-xl"><span class="text-green-500 dark:text-green-400">Email:</span> <a href="mailto:{{$detail->email}}">  {{$detail->email}}</a>
        </x-checkmark></div>
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Phone Number:</span>  <a href="tel:{{$detail->phone}}">  {{$detail->phone}}</a>
        </x-checkmark></div>
      
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Type:</span>  {{Str::of($detail->type->name)->upper()}}
        </x-checkmark></div>

<div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Credentials: </span> <a type="button"  wire:click='download({{$detail->id}})'> <svg class="w-8 h-8 text-green-500  dark:text-green-500 hover:cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
    <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd" />
  </svg>
</a>
  
        </x-checkmark></div>

        <div class="p-4 col-span-6 md:col-span-6 text-center"> 
           
              <button type='button'  class="btn btn-outline btn-success" wire:click='try_save' > 
                Register Center  <div class="text-green-500" wire:loading>
                  @include('utils.spinner')
              </div></button>
              
             
             
            
        </div>
        <div class="p-4 col-span-6 md:col-span-6 text-center"> 
           
          <button type='button'  class="btn btn-outline btn-warning" wire:click='try_delete' > 
            Delete Center  <div class="text-green-500" wire:loading>
              @include('utils.spinner')
          </div></button>
          
         
        </div>
        
 
      
@else

        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Name:
        </x-checkmark></div>
        
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Adress:
        </x-checkmark></div>
  
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark>Email:
        </x-checkmark></div>
        <div class="p-4 col-span-12 md:col-span-8"> <x-checkmark>Phone Number:
        </x-checkmark></div>
        <div class="p-4 col-span-12 md:col-span-6"> <x-checkmark>Type:
        </x-checkmark></div>

<div class="p-4 col-span-12 md:col-span-6"> <x-checkmark>Credentials:
        </x-checkmark></div>
        @endif
</div>




<script>



window.addEventListener('deletedialog',function(e){
    Swal.fire({
  icon: "warning",
  title : 'Are you sure to Delete center? ',
  showCancelButton: true,
text:"Will be saved if you choose OK!",
  confirmButtonColor: "#d33",
  cancelButtonColor: "#00ca92",
  confirmButtonText: "Yes, Delete it!"
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
 window.addEventListener('swal_saved',function(e){
    Swal.fire({
  icon: "warning",
  title : 'Are you sure to Register center? ',
  showCancelButton: true,
text:"Will be saved if you choose OK!",
  confirmButtonColor: "#00ca92",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Register it!"
}).then((result) => {
  if (result.isConfirmed) {
    @this.dispatch('gosave');
    Swal.fire({
      title: "Registered!",
      text: "Centered  has been Registered.",
      icon: "success"
    });
  }
 
 
});
        });



</script>

