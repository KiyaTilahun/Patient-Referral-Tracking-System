


<!DOCTYPE html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link defer href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
     
        
           
        <div class="fixed left-2 top-2">
           @include('utils.theme')
  
                <!-- this hidden checkbox controls the state -->
            
        </div>

               
                <div class="h-screen flex justify-center">
                    <div class="container ">
                              <div class="col-md-6 offset-md-3">
                                  
                                  <livewire:hospital.register>
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





