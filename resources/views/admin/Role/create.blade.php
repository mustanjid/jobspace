<section class="bg-white dark:bg-gray-900">
    <div class="py-2 px-4 mx-auto max-w-2xl lg:py-2">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new role</h2>
        <form action="/admin/roles/add" method="POST">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Type role name" required="">
                </div>
            </div>

            <label class="block mb-2 text-sm mt-6 font-medium text-gray-900 dark:text-white">Click below for assigning
                tasks </label>
            {{-- user role --}}
            <div class="mt-6">
                @foreach ($getPermission as $value)
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        @foreach ($value['group'] as $group)
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center ps-3">
                                    <input id="{{ $group['name'] }}" type="checkbox" value="{{ $group['id'] }}" name="permission_id[]"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="{{ $group['name'] }}"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $group['name'] }}</label>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                @endforeach
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-6 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
                role</button>
        </form>
    </div>
</section>
