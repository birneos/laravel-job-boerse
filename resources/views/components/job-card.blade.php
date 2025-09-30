@props(['job']) 
  <x-job-panel class="flex-col text-center">
            <div class="self-start text-sm">{{ $job->employer->name }}</div>
            <div class="py-8 font-bold">
                <h3 class="group-hover:text-blue-600 text-xl font-bold  transition-colors duration-300">
                  <a href="/jobs/{{ $job->url }}" target="_blank" rel="noopener noreferrer">
                    {{$job->title}}
                  </a>
                </h3>
                <p class="text-sm mt-4">{{ $job->schedule }} - {{$job->salary}}</p>
            </div>
            <div class="flex justify-between items-center mt-auto">
               <div>
                @foreach($job->tags as $tag)
                  <x-tag size="small" :tag="$tag"/>
                @endforeach
               </div>

                <x-employer-logo :employer="$job->employer" :width="42"/>
            </div>
            <div class="self-start text-xs text-gray-400 mt-4">
              {{ $job->created_at->diffForHumans() }}
            </div>
</x-job-panel>