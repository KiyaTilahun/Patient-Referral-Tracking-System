
<div class="mx-auto grid grid-cols-12 gap-4  p-1">
   

    
    <div class="header col-span-12 rounded-lg bord py-8">
        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Center</span> Management   </h1>
       
    </div>
    <div class="col-span-12 rounded-lg sm:col-span-7">
        <livewire:hospital.center.center-table/>
    </div>
    <div class="col-span-12 rounded-lg  shadow-md sm:col-span-5">
        
     
{{-- center saved start --}}


{{-- <x-auth-session-status class="mb-4" :status="session('status')"  /> --}}

{{-- center saved End --}}

        <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-2xl text-center"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">health center detail</span>  </h1>
        {{-- <livewire:hospital.pending.pending-detail/> --}}

    </div>
    {{-- <div class="footer col-span-12 rounded-lg border border-gray-800 bg-gray-700 p-6">
      <!-- Footer content -->
    </div> --}}
  </div>