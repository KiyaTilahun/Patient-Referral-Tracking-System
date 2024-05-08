<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<style type="text/css">
      .text-9xl{
      font-size: 14rem;
      }
      @media(max-width: 645px){
      .text-9xl{
      font-size: 5.75rem;
      }
      .text-6xl{
      font-size: 1.75rem;
      }
      .text-2xl {
      font-size: 1rem;
      line-height: 1.2rem;
      }
      .py-8 {
      padding-top: 1rem;
      padding-bottom: 1rem;
      }
      .px-6 {
      padding-left: 1.2rem;
      padding-right: 1.2rem;
      }
      .mr-6{
      margin-right: 0.5rem;
      }
      .px-12 {
      padding-left: 1rem;
      padding-right: 1rem;
      }
      }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let countdown = 5; // Countdown time in seconds
            const interval = setInterval(() => {
                if (countdown > 0) {
                    document.getElementById('countdown').textContent = countdown;
                    countdown -= 1;
                } else {
                    clearInterval(interval);
                    window.location.href = "{{ route('login') }}"; // Redirect to the login page
                }
            }, 1000); // Update every second
        });
        </script>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="bg-gradient-to-r bg-gray-800 text-warning">
<div class="w-9/12 m-auto py-16 min-h-screen flex items-center justify-center">
<div class="bg-gray-800 overflow-hidden sm:rounded-lg pb-8">
<div class="  text-center pt-8">
<h1 class="text-9xl font-bold text-purple-400">401</h1>
<h1 class="text-6xl font-medium py-8 "> UnAuthorized Access </h1>
<p class="text-2xl pb-8 px-12 font-medium">Please login before access.</p>
<p class="text-2xl pb-8 px-12 font-medium">Redirecting in <span id="countdown">5</span> seconds...</p>
<a href="{{ route('login') }}">
<button class="btn btn-info  font-semibold px-6 py-3 rounded-md mr-6">
Login
</button>
</a>

</div>
</div>
</div>
</div>
</body>
</html>