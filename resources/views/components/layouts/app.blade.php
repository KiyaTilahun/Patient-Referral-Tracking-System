<x-layouts.base>
    @auth
       
                @include('layouts.navbars.auth.sidebar')
                <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
                    @include('layouts.navbars.auth.nav')
                    <div class="w-3/4 md:w-full px-6 py-6 mx-auto">
                        {{ $slot }}
                        
                    </div>
                </main>
           

           
    
    @endauth

    @guest
        @if (in_array(request()->route()->getName(),['static-sign-up', 'register']))
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                    @include('layouts.navbars.guest.nav')
                </div>
            </div>
            {{ $slot }}
        @elseif (in_array(request()->route()->getName(),['static-sign-in', 'login', 'forgot-password', 'reset-password']))

        <div class="container sticky top-0 z-sticky">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                    @include('layouts.navbars.guest.nav')
                </div>
            </div>
        </div>
    
            {{ $slot }}
        @endif


    @endguest

</x-layouts.base>
