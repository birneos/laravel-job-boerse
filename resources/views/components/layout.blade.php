<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Boerse</title>
   

  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-black">
  <div class="px-10">
      <nav class="flex justify-between items-center px-4">
        <div>
          <a href="/">
            <image src="{{ Vite::asset('resources/images/logo.svg') }}"></image>
          </a>
        </div>
        <div>
            <a href="#">Jobs</a>
            <a href="#">Careers</a>
            <a href="#">Salaries</a>
            <a href="#">Compoanies</a>
        </div>
        <div><a href="#">Post the Job</a></div>
      </nav>

      <main>{{$slot}}</main>
  </div>
  
</body>
</html>