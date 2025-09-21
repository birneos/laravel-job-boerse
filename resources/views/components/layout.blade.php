<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Boerse</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-black text-white font-hanken-grotesk pb-30">
  <div class="px-10">
      <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <div >
          <a href="/">
            <image src="{{ Vite::asset('resources/images/logo.svg') }}"></image>
          </a>
        </div>
        <div class="space-x-6 font-bold">
            <a href="#">Jobs</a>
            <a href="#">Careers</a>
            <a href="#">Salaries</a>
            <a href="#">Compoanies</a>
        </div>
        @auth
        <div><a href="/jobs/create">Post the Job</a></div>   
        @endauth

        @guest
         <div class="space-x-6 font-bold">
            <a href="/register">Signup</a>
            <a href="/login">Login</a>
        </div>
        @endguest
      </nav>

      <main class="mt-10 max-w-[986px] mx-auto">{{$slot}}</main>
  </div>
  
</body>
</html>