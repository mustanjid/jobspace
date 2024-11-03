 <div class="pb-4 bg-white dark:bg-gray-900">
        <input type="text" wire:model.debounce.300ms="searchTerm" id="table-search"
            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search for jobs by employer">
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-40">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Employer</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Salary</th>
                    <th scope="col" class="px-6 py-3">Location</th>
                    <th scope="col" class="px-6 py-3">Schedule</th>
                    <th scope="col" class="px-6 py-3">Featured</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empjobs as $job)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $job->employer->name }}</td>
                        <td class="px-6 py-4">{{ $job->title }}</td>
                        <td class="px-6 py-4">{{ $job->salary }}</td>
                        <td class="px-6 py-4">{{ $job->location }}</td>
                        <td class="px-6 py-4">{{ $job->schedule }}</td>
                        <td class="px-6 py-4">{{ $job->featured ? 'Featured' : 'Unfeatured' }}</td>
                        <td class="px-6 py-4">{{ $job->status ? 'Active' : 'Inactive' }}</td>
                        <td class="flex justify-between items-center gap-2 px-6 py-4">
                            <button wire:click="edit({{ $job->id }})" type="button"
                                class="text-xs text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">Edit</button>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $empjobs->links() }}
    </div>