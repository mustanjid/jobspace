<x-layout>
    @if (session('success'))
    <div id="successMessage" class="flex items-center bg-blue-500 px-4 py-3 text-sm font-bold text-white" role="alert">
        <svg class="mr-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if (session('error'))
    <div id="alert-2"
        class="mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            {{ session('error') }}
        </div>
    
    
    </div>
    @endif
    
    <x-page-heading>Update Password</x-page-heading>
    <div class="flex justify-center px-4 space-y-5 mb-8">
        <x-forms.form method="POST" action="/update-password" class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            <x-forms.input label="Current Password" name="current_password" type="password" />
            <x-forms.input label="New Password" name="new_password" type="password" />
            <x-forms.input label="Confirm New Password" name="new_password_confirmation" type="password" />
            <div class="mb-8">
                <x-forms.button>Update Password</x-forms.button>
            </div>
        </x-forms.form>
    </div>

</x-layout>