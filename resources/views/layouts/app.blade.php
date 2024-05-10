<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div> --}}
        
        <div class="fixed right-2 bottom-2 z-50">
            @include('utils.theme')
   
                 <!-- this hidden checkbox controls the state -->
             
         </div>
 
         
                
                 <div class="h-screen flex justify-center">
                     <div class="container ">
                               <div class="col-md-6 offset-md-3">
                                   
                                {{ $slot }}
                               </div>
                         
                     </div>
                 </div>
 
                 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                 <script>
                     const themeToggle = document.getElementById('themeToggle');
                     const html = document.querySelector('html');
             
                     themeToggle.addEventListener('change', () => {
                         if (themeToggle.checked) {
                             html.setAttribute('data-theme', 'light');
                             html.classList.add('light');
                             html.classList.remove('dark');
                         } else {
                             html.setAttribute('data-theme', 'dark');
                             html.classList.add('dark');
                             html.classList.remove('light');
                         }
                     });
                 </script>

    </body>
</html>
