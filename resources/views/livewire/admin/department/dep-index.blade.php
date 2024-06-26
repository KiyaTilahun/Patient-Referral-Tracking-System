<div class="mx-auto grid grid-cols-12 gap-4  p-1">


    <div class="header col-span-12 rounded-lg bord py-8">
        {{-- <h2 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-5xl"><span
                class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Center</span>
            Departments </h2> --}}

            <x-breadcrumb> <li class="inline-flex items-center">
                <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                  <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                  </svg>
                  Home
                </a>
              </li>
              <li>
                <div class="flex items-center ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400">
                  <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  Department Management
                </div>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
                  <span class="ms-1 text-sm font-medium  dark:text-white text-blue-600"> Departments</span>
                </div>
              </li></x-breadcrumb>
              <x-page-heading :title="'Departments'" />


    </div>
    <div class="col-span-12 rounded-lg sm:col-span-7">
        <div class="text-right">
            <button class="btn btn-outline btn-success" wire:click='newdep'>Add new Department</button>
        </div>
        <div class="sm:max-h-[50vh] overflow-y-auto">
        @foreach ($hospital->departments as $department)
         
            <x-mary-list-item :item="$department" >
                <x-slot:actions>

                    <x-mary-button icon="s-pencil-square" class="text-green-500"
                        wire:click="showperm({{ $department->id }})" spinner />

                </x-slot:actions>
            </x-mary-list-item>
          
        @endforeach
       
    </div>

    </div>
    <div class="col-span-12 rounded-lg  shadow-md sm:col-span-5 ">


        {{-- center saved start --}}


        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- center saved End --}}

        <h1 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-2xl text-center"><span
                class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">department referral
                detail</span> </h1>
                <div class="sm:max-h-[50vh] overflow-y-auto">
        <livewire:admin.department.edit-index />
                </div>


    </div>


  
</div>
