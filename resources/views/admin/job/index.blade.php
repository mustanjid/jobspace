<x-dashboard-layout>

    <div class="pb-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search"
                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for jobs">
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-40">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Employer
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Salary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Schedule
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Featured
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($empjobs as $empjob)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $empjob->employer->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $empjob->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $empjob->salary }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $empjob->location }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $empjob->schedule }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($empjob->featured)
                                <div class="text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                    role="alert">
                                    <span class="font-medium"> {{ 'Featured' }}</span>
                                </div>
                            @else
                                {{ 'Unfeatured' }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($empjob->status)
                                <div class="text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                    role="alert">
                                    <span class="font-medium">{{ 'Active' }}</span>
                                </div>
                            @else
                                <div class="text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium"> {{ 'Inactive' }}</span>
                                </div>
                            @endif
                        </td>

                        <td class="flex justify-between items-center gap-2 px-6 py-4">
                            <a type="button" href="#"
                                class="text-xs text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300  shadow-blue-500/50 font-medium rounded-lg px-5 py-2.5 text-center me-2 mb-2">Edit</a>
                            @if (in_array('admin', Auth::user()->positions->pluck('name')->collect()->toArray()))
                                <a href="#" type="button"
                                    class="text-xs text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300  shadow-red-500/50 font-medium rounded-lg px-5 py-2.5 text-center me-2 mb-2">Delete</a>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $empjobs->links() }}
    </div>
    </div>


</x-dashboard-layout>
