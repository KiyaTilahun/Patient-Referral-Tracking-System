<div class="flex-col w-full">
<x-login-session-status class="pt-4" :status="session('user')" />

    <div class="header col-span-12 rounded-lg bord py-4">
        {{-- <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-5xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Center</span> Management   </h1> --}}
        <x-breadcrumb>
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400">
                    <svg class="w-3 h-3 text-gray-400 mx-1 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    Dashboard
                </div>
            </li>
            
        </x-breadcrumb>
        <x-page-heading :title="'DashBoard'" />

    </div>

    @if ($user->hasRole('superadmin'))

    <div class="w-full inline-flex"> 
        <x-mary-stat title="Regions" description="Total Regions" value="{{$regioncount}}" icon="o-arrow-trending-down"
        tooltip-left="region!" class="text-orange-500" />
        <x-mary-stat title="Centers" description="Total center" value="{{$centercount}}" icon="m-home-modern" class="text-orange-500"
            tooltip-bottom="centers" />

      

        <x-mary-stat title="Patients" description="Total Patients" value="{{$patientcount}}" icon="o-user-circle"
            class="text-orange-500" color="text-pink-500" tooltip-right="patients!" />
            
        <x-mary-stat title="Referrals" description="Total Referrals" value="{{$referralcount}}" icon="o-clipboard-document-check"
        class="text-orange-500" color="text-blue-500" tooltip-right="Referrals!" />
            
            
    </div>

   
    <div class="grid grid-cols-3 md:mt-6">
        <div class="md:col-span-2 col-span-3 flex flex-col items-start ">
            <div class="my-6">Number of Medical Centers by Region</div><x-mary-chart wire:model="myChart" class="w-full" />
           
        </div>
        <div class="md:col-span-1 col-span-3 flex flex-col items-start">
            <div class="my-6">Number of Medical Centers by Type</div><x-mary-chart wire:model="myChart2" class="w-full" />
           
        </div>

    </div>
   
        
    @else
        
    @if ($user->hasRole('admin'))

    <div class="w-full inline-flex"> 
        <x-mary-stat title="Users" description="Total Regions" value="{{$hospitalusers}}" icon="o-user-circle"
        tooltip-left="users!" class="text-orange-500" />
     

      

        <x-mary-stat title="Patients" description="Total Patients" value="{{$patientcount}}" icon="o-user-group"
            class="text-orange-500" color="text-pink-500" tooltip-right="patients!" />
            
            <x-mary-stat title="Referrals" description="Total Outbound Referrals" value="{{$outboundcount}}" icon="o-clipboard-document-check"
            class="text-orange-500" color="text-blue-500" tooltip-right="Outobund Referrals!" />
        <x-mary-stat title="Referrals" description="Total Inbound Referrals" value="{{$inboundcount}}" icon="o-clipboard-document-check"
        class="text-orange-500" color="text-green-500" tooltip-right="Inobund Referrals!" />
            
       
    </div>
    
        
  
    

@else
<div class="w-full inline-flex"> 
<x-mary-stat title="Referrals" description="Total Outbound Referrals" value="{{$outboundcount}}" icon="o-clipboard-document-check"
class="text-orange-500" color="text-blue-500" tooltip-right="Outobund Referrals!" />
<x-mary-stat title="Referrals" description="Total Inbound Referrals" value="{{$inboundcount}}" icon="o-clipboard-document-check"
class="text-orange-500" color="text-green-500" tooltip-right="Inobund Referrals!" />
</div>
    @endif
    @endif

    
   

   
    <div class=" p-3 shadow-sm rounded-sm">
        <div class="flex items-center space-x-2 font-semibold  leading-8">
          
            <span class="mb-4 text-2xl font-bold leading-none tracking-tight text-gray-900 md:text-2xl dark:text-white">My Profile</span>
        </div>
        <div >
            <div class="grid md:grid-cols-2 text-sm">
               
                <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Full Name</div>
                    <div class="px-4 py-2">{{$user->name}}</div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Email.</div>
                    <div class="px-4 py-2">
                        <a class="text-blue-800" href="mailto:jane@example.com">{{$user->email}}</a>
                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Role</div>
                    <div class="px-4 py-2">{{$user->getRoleNames()->first()}}</div>
                </div>
                @if (!auth()->user()->hasRole('superadmin'))
                <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Health Center</div>
                    <div class="px-4 py-2">{{$user->hospital->name}}</div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="px-4 py-2 font-semibold">Current Address</div>
                    <div class="px-4 py-2">{{$user->hospital->zone}},{{$user->hospital->region->name}}</div>
                </div>
                @endif
           
            </div>
        </div>
        <div class="fit-content">
        <x-nav-link :href="route('editprofile')" wire:navigate>
            <x-mary-button label="Edit Profile"  icon="s-user-circle" class="text-warning" />
            
        </x-nav-link>
    </div>
        
        {{-- <button
            class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Edit Profile</button> --}}
            {{-- <x-mary-button label="Change Password"  icon="s-lock-closed" class="text-warning" /> --}}
    </div>
 

    
    
</div>

</div>
