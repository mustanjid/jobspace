<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="90,000 Tk || 40,000-50,000 TK" />
        <x-forms.input label="Location" name="location" placeholder="Dhaka, Bangladesh" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Select</option>
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="Backend, Php, Js" />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>
