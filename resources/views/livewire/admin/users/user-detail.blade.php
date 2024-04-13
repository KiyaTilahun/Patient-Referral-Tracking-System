<div>
    @if (!is_null($detail))
  <div class="flex justify-between">  <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-2xl text-left md:pr-4"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">user details</span>  </h1>
    <x-mary-button label="Edit User" wire:click="edituser" icon="c-pencil-square"  /></div>

<div class="grid grid-cols-12  ">



   

    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Name:</span>  {{$detail->name}}
        </x-checkmark></div>
        
    <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Center:</span>  {{$detail->hospital->name}}
        </x-checkmark></div>
  
    <div class="p-4 col-span-12 md:col-span-12 "> <x-checkmark class="text-xl"><span class="text-green-500 dark:text-green-400">Email:</span> <a href="mailto:{{$detail->email}}">  {{$detail->email}}</a>
        </x-checkmark></div>
      
      
        <div class="p-4 col-span-12 md:col-span-12"> <x-checkmark><span class="text-green-500 dark:text-green-400">Role:</span> @foreach ($detail->roles as $role)
            {{ Str::upper($role['name']) }}
        @endforeach
        </x-checkmark></div>



       
       
        
 
      
@else
<div class="flex justify-between">  <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-2xl text-left md:pr-4"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">user details</span>  </h1>
    <x-mary-button label="Edit User"  icon="c-pencil-square" disabled /></div>
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



    window.addEventListener('swal_deactivate',function(e){
        Swal.fire({
      icon: "warning",
      title : 'Are you sure to Deactivate center? ',
      showCancelButton: true,
    text:"Will be saved if you choose OK!",
      confirmButtonColor: "#d33",
      cancelButtonColor: "#00ca92",
      confirmButtonText: "Yes, Deactivate it!"
    }).then((result) => {
      if (result.isConfirmed) {
        @this.dispatch('godeactivate');
        Swal.fire({
            position: "top-end",
          title: "Deactivated!",
          text: "Centere  has been deactivated.",
          icon: "warning"
        });
      }
     
     
    });
            });


            window.addEventListener('swal_activate',function(e){
        Swal.fire({
      icon: "warning",
      title : 'Are you sure to Activate center? ',
      showCancelButton: true,
    text:"Will be saved if you choose OK!",
      confirmButtonColor: "#00ca92",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Activate it it!"
    }).then((result) => {
      if (result.isConfirmed) {
        @this.dispatch('goactivate');
        Swal.fire({
            position: "top-end",
          title: "Activated!",
          text: "Centere  has been activated.",
          icon: "success"
        });
      }
     
     
    });
            });
</script>
