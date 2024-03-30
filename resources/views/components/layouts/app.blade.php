<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">

    @auth
   
            <livewire:utils.sidebar>
            <livewire:utils.navbar>
 

                <div class="p-4 sm:ml-64">
                    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                        {{ $slot }}
                    </div>
                </div>

            @endauth





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

            
            @livewireScripts
</body>

</html>
