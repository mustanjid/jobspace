<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Job Space</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @guest
                @if (Route::is('loginForm'))
                    <x-nav-button href="{{ url('/register') }}">Sign Up</x-nav-button>
                @elseif (Route::is('signupForm'))
                    <x-nav-button href="{{ url('/login') }}">Log in</x-nav-button>
                @else
                    <x-nav-button href="{{ url('/login') }}">Log in</x-nav-button>
                @endif
            @endguest

            @auth
                <div class="flex justify-between gap-4 mx-auto">
                    @if (Auth::user()->positions->count())
                        <x-nav-button href="{{ url('/admin/dashboard') }}">View Dashboard</x-nav-button>
                    @else
                        @if (Auth::user()->status)
                            <x-nav-button href="{{ url('/jobs/create ') }}">Post a Job</x-nav-button>
                        @endif
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                type="button">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" src="{{ Storage::url(Auth::user()->employer->logo) }}"
                                    alt="user photo">
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownAvatar"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                                    <div class="font-medium truncate">{{ Auth::user()->employer->name }}</div>
                                </div>
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownUserAvatarButton">
                                    <li>
                                        <a href="{{ url('/jobs/create ') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Post
                                            a Job</a>
                                        <a href="{{ url('/emp-job-view') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View
                                            Jobs</a>
                                        <a href="{{ url('/emp-job-view') }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Update
                                            Employer</a>
                                    </li>
                                </ul>
                                <div class="py-2">
                                    <form method="POST" action="/logout">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Log
                                            Out</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                </div>
            @endauth

            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <x-nav-links href="/" :active="request()->is('/')">Home</x-nav-links>
                <x-nav-links href="">Careers</x-nav-links>
                <x-nav-links href="">Salaries</x-nav-links>
            </ul>
        </div>

    </div>
</nav>
