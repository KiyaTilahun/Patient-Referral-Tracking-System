<div>
    <div class="pt-4 py-5"> <x-breadcrumb> <li class="inline-flex items-center">
        <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
          <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
          </svg>
          Home
        </a>
      </li>
     
      <li aria-current="page">
        <div class="flex items-center">
          <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="ms-1 text-sm font-medium dark:text-white text-blue-600 md:ms-2">Settings</span>
        </div>
      </li></x-breadcrumb>
      <x-page-heading :title="'Settings'" /></div>


      

        

<div class="relative overflow-x-auto ">
    <table class="w-1/2 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
       
        <tbody>
            {{-- <tr class="">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                    <span class="flex items-center gap-2 p-2"><x-mary-icon name="m-cursor-arrow-rays" class="text-green-500 mr-4"/>  <span>Change Theme Color</span></span>
                </th>
                <td class="text-left">
                    @include('utils.theme')
                </td>
                
            </tr> --}}
            @if (auth()->user()->hasRole(['superadmin']))
            <tr class=" ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                   
                    <x-nav-link :href="route('departmentlist')" wire:navigate>
                        <span class="flex items-center gap-2 cursor-pointer"><x-mary-icon name="m-cursor-arrow-rays" class="text-green-500 mr-4"/>  <span>Edit Departments</span><x-mary-icon name="o-adjustments-horizontal"  /></span>
                    </x-nav-link>
                </th>
                <td class=" py-4">
                    
                </td>
                
            </tr>
            @endif
            {{-- <tr class=" ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                   
                    <x-nav-link :href="route('holidaylist')" wire:navigate>
                        <span class="flex items-center gap-2 cursor-pointer"><x-mary-icon name="m-cursor-arrow-rays" class="text-green-500 mr-4"/>  <span>Edit Holidays</span><x-mary-icon name="s-calendar"  /></span>
                    </x-nav-link>
                </th>
                <td class=" py-4">
                    
                </td>
                
            </tr> --}}
            <tr class=" ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                    <x-nav-link :href="route('deletedusers')" wire:navigate>
                    <span class="flex items-center gap-2 cursor-pointer"><x-mary-icon name="m-cursor-arrow-rays" class="text-green-500 mr-4"/>    <span>   Deleted Users   </span><x-mary-icon name="o-trash" class="text-error mr-4" /></span>
                </x-nav-link>


                   
                
                </th>
                <td class=" py-4">
                    
                </td>
                
            </tr>
            <tr class=" ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                    <x-nav-link :href="route('editprofile')" wire:navigate>
                    <span class="flex items-center gap-2 cursor-pointer"><x-mary-icon name="m-cursor-arrow-rays" class="text-green-500 mr-4"/>    <span>   Edit Your Profile   </span><x-mary-icon name="s-user-circle" class="text-warning mr-4" /></span>
                </x-nav-link>


                   
                
                </th>
                <td class=" py-4">
                    
                </td>
                
            </tr>
            <tr class=" ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-lg">
                   
                    <livewire:logout>
                </th>
                <td class=" py-4">
                    
                </td>
                
            </tr>
           
         
        </tbody>
    </table>
</div>

     
</div>
