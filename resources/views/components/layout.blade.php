<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Boerse</title>
  @vite(['resources/js/app.js'])
</head>
<body>
  <div>
      <nav>
        <div>
          <a href="">
            <image src="{{ Vite::asset('resources/images/log.svg') }}"></image>
          </a>
        </div>
        <div>links</div>
        <div>post a job</div>
      </nav>

      <main>{{$slot}}</main>
  </div>
  
</body>
</html>