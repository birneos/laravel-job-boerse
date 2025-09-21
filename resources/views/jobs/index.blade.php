<x-layout>
   <div class="space-y-10">
     <section class="text-center pt-6">
        <h1 class="font-bold text-4xl">Lets find your Job</h1>
        <!-- <form action="" class="mt-6">
            <input type="text" class="rounded-xl bg-white/10 border-white/10 px-5 py-4 w-full max-w-xl" placeholder="I am looking for"/>
        </form> -->
        <x-forms.form method="GET" action="/search" class="mt-6">
            <x-forms.input :label="false" name="q" placeholder="Search by title, skills, or company" />
        </x-forms.form>
     </section>

     <section class="pt-10">
        <x-section-heading>Featured Job</x-section-heading>

        <div class="grid lg:grid-cols-3 gap-8 mt-6">
            @foreach($jobsFeatured as $job)
              <x-job-card :job="$job"/>
            @endforeach
       
        </div>
    </section>

    <section>
        <x-section-heading>Tags</x-section-heading>
        <div class="mt-6 space-x-1">
          @foreach( $tags as $tag)
            <x-tag :tag="$tag" size="small"/>
          @endforeach
         
           
        </div>
    </section>

    <section>
        <x-section-heading>Recent Jobs</x-section-heading>
        <div class="mt-6 space-y-6">
            @foreach($jobsRecent as $job)
              <x-job-card-wide :job="$job"/>
            @endforeach
         
        </div>
    </section>

   </div>
    
</x-layout>