<x-layouts.base>
    @auth
       
                @include('components.layouts.navbars.auth.sidebar')
                
                    @include('components.layouts.navbars.auth.nav')
                    <div class="p-4 sm:ml-64">
                        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                       {{$slot}}
                        </div>
                     </div>
               
           

           
    
    @endauth


</x-layouts.base>