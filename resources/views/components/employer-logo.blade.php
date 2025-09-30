@props(['employer','width'=>90])
<!-- <img src="https://picsum.photos/seed/{{rand(500,10000000)}}/{{$width}}/{{$width}}" class="rounded-xl"> -->
<img src="{{ $employer->url }}" class="rounded-xl">
   