<x-layout>
  <x-page-heading>New Job</x-page-heading>

  <x-forms.form method="POST" action="/jobs" enctype="multipart/form-data">

    <x-forms.input label="Job Title" name="title" placeholder="CEO" />
    <x-forms.input label="Salary" name="salary" placeholder="$90.000" />
    <x-forms.input label="Location" name="location" placeholer="Winter park, Florida" />

    <x-forms.select label="Job Type" name="schedule" label="Schedule">
      <option value="full-time">Full Time</option>
      <option value="part-time">Part Time</option>
      <option value="contract">Contract</option>
      <option value="internship">Internship</option>
    </x-forms.select>

    <x-forms.input label="Url" name="url" placeholder="https://acme.com/jobs/ceo-wanted" />
    <x-forms.checkbox label="Feature (Cost extra)" name="featured" />
    
    <x-forms.divider/>

    <x-forms.input label="Tags (Comma Separated)" name="tags" placeholder="laracasts, video, education"/>
   
    <x-forms.button>Publish</x-forms.button>
  </x-forms.form>
</x-layout>