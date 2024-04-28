<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">

                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <span class="flex ms-2 md:me-24">
                    {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> --}}
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">PRTS</span>
                        @if (!(auth()->user()->hasRole('superadmin')))
                            
                       
                        <span
                                                    class="hidden md:inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{auth()->user()->hospital->name}}  <div class="ml-4 badge text-[#00ca92]">{{auth()->user()->hospital->region->name}},Ethiopia
                                                     </div></span>
                                                     @endif
                                                    </span>
            </div>

            <div class="flex items-center ">
                <div class="flex items-center ms-3">
                    <div class="avatar online placeholder mr-2">
                        <div class="bg-neutral text-neutral-content rounded-full w-10">
                            <span class="text-xl ">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    {{-- {{auth()->user()->hospital->name}} --}}
                    <div class="flex flex-col gap-1">
                        <span class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            {{ auth()->user()->name }}
                          </span>
                          <span class="inline-flex self-end justify-center px-2 border-success  dark:border-warning border-[1px] ms-3 text-xs font-medium text-success bg-gray-200 rounded dark:bg-gray-700 dark:text-warning">
                            {{ auth()->user()->getRoleNames()->first()}}
                          </span>
                    </div>
                   


                </div>
      


            </div>
        </div>
    </div>
</nav>
