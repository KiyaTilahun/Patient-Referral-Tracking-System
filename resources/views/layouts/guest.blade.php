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

<body class="font-sans text-gray-900 antialiased">
    {{-- <div class="loader1 flex flex-col h-screen w-full items-center justify-center bg-blue-600-">
        <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-5xl">Welcome to <span
            class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Patient Referral Tracking System</span>
         </h1>

        <svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <style>
                .spinner_9Mto {
                    fill: #38bdf8;
                }

                spinner_bb12 {
                    fill: #38bdf8;
                }

                .spinner_9Mto {
                    animation: spinner_5GqJ 1.6s linear infinite;
                    animation-delay: -1.6s;
                }

                .spinner_bb12 {
                    animation-delay: -1s;
                }

                @keyframes spinner_5GqJ {
                    12.5% {
                        x: 13px;
                        y: 1px;
                    }

                    25% {
                        x: 13px;
                        y: 1px;
                    }

                    37.5% {
                        x: 13px;
                        y: 13px;
                    }

                    50% {
                        x: 13px;
                        y: 13px;
                    }

                    62.5% {
                        x: 1px;
                        y: 13px;
                    }

                    75% {
                        x: 1px;
                        y: 13px;
                    }

                    87.5% {
                        x: 1px;
                        y: 1px;
                    }
                }
            </style>
            <rect class="spinner_9Mto" x="1" y="1" rx="1" width="10" height="10" />
            <rect class="spinner_9Mto spinner_bb12" x="1" y="1" rx="1" width="10" height="10" />
        </svg>
    </div> --}}
   
    <div  style="background-image:url('{{ asset('images/loginlogo.jpg') }}');background-size: cover;" class="w-full h-screen  min-h-screen  flex justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900  bg-center bg-no-repeat bg-[url('{{ asset('images/loginlogo.jpg') }}')] bg-gray-700 bg-blend-multiply"
        id="content">
        <div>
            <a href="/" wire:navigate>
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </div>

        <div
            class="sm:w-1/2 w-md mt-6  bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            
            {{ $slot }}
        </div>
    </div>
    <div class="fixed right-2 bottom-2">
        @include('utils.theme')

             <!-- this hidden checkbox controls the state -->
         
     </div>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loader = document.querySelector(".loader1");
            const content = document.getElementById("content");

            // Show loader

            // Hide loader and show content after 3 seconds
            setTimeout(function() {
                loader.style.display = "none";
                content.style.display = "flex";
            }, 3000);
        });
    </script> --}}
</body>

</html>
