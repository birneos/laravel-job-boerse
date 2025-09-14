  @props(['job'])
  <x-job-panel class="gap-x-6">
       <div>
      <x-employer-logo/>
    </div>
    <div class="flex-1 flex flex-col">
        <a href="" class="self-start text-sm text-gray-400">{{ $job->employer->name }}</a>
        <h3 class="font-bold text-xl mt-1 group-hover:text-blue-600 transition-colors duration:300">{{$job->title}}</h3>
        <p class="text-sm text-gray-400 mt-auto">{{$job->schedule}} - {{$job->salary}}</p> 
    </div>
    <div>
      @foreach($job->tags as $tag)
        <x-tag size="small" :tag="$tag"/>
      @endforeach
    
    </div>
</x-job-panel>