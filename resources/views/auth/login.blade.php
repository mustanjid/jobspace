<x-layout>
    <x-page-heading>Log In</x-page-heading>

  <div class="flex justify-center px-4">
    <x-forms.form method="POST" action="/login" class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.button>Log In</x-forms.button>
    </x-forms.form>
</div>
</x-layout>
