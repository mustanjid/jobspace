<div>
    <x-dashboard-layout>

        @if (session('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Update</span>
                <div class="ms-3 text-sm font-medium">

                    {{ session('success') }}

                </div>
            </div>
        @endif

        @if (session('failure'))
            <div id="alert-2"
                class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('failure') }}
                </div>


            </div>
        @endif

        <div class="mx-auto max-w-screen-xl px-4 lg:px-1"">
            <h1 class="text-sm text-center p-2">All Jobs</h1>
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex w-2/3 justify-between">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-1/2 pl-10 p-2 "
                                placeholder="Search by title, employer" required="">
                        </div>
                        <button type="button" wire:click="resetFields()"
                            class="px-3 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 hover:bg-gray-400 block w-1/5 ">Reset
                            Filters</button>
                    </div>

                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900">Status Type :</label>
                            <select wire:model.live.debounce.300ms="isActive"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                @include('livewire.includes.table-sortable-th', [
                                    'displayName' => 'Employer',
                                    'name' => 'name',
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                    'displayName' => 'Title',
                                    'name' => 'title',
                                ])
                                <th scope="col" class="px-4 py-3">Salary</th>
                                <th scope="col" class="px-4 py-3">Location</th>
                                <th scope="col" class="px-4 py-3">Url</th>
                                <th scope="col" class="px-4 py-3">Scehdule</th>
                                <th scope="col" class="px-4 py-3">Featured</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Actions
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr wire:key={{ $job->id }} class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $job->employer->name }}</th>
                                    <td class="px-4 py-3"> {{ $job->title }}</td>
                                    <td class="px-4 py-3"> {{ $job->salary }}</td>
                                    <td class="px-4 py-3"> {{ $job->location }}</td>
                                    <td class="px-4 py-3"> {{ $job->url }}</td>
                                    <td class="px-4 py-3"> {{ $job->schedule }}</td>
                                    @if ($job->featured)
                                        <td class="px-4 py-3 text-green-500">Featured</td>
                                    @else
                                        <td class="px-4 py-3 text-red-500">Unfeatured</td>
                                    @endif
                                    @if ($job->status)
                                        <td class="px-4 py-3 text-green-500">Active</td>
                                    @else
                                        <td class="px-4 py-3 text-red-500">Inactive</td>
                                    @endif
                                    <td class="px-4 py-3">
                                        <button wire:click="edit({{ $job->id }})"
                                            class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        @if (in_array('admin', Auth::user()->positions->pluck('name')->collect()->toArray()))
                                            <button wire:click="openDeleteModal({{ $job->id }})"
                                                class="text-sm text-red-500 font-semibold rounded hover:text-teal-800 mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3 flex justify-between">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live='perPage'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>

        @if ($isOpen)
            <div
                class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <p>Edit Job Form</p>
                    <div class="">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <form wire:submit="update">
                                @csrf
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                                        </label>
                                        <input type="text" wire:model="jobEditTitle" id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Web Developer" />
                                        @error('jobEditTitle')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div>
                                        <label for="salary"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                        <input type="text" id="salary" wire:model="jobEditSalary"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="40,000 - 50,000 Tk" required />
                                        @error('jobEditSalary')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="location"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                        <input type="text" id="location" wire:model="jobEditLocation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Dhaka, Bangladesh" required />
                                        @error('jobEditLocation')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="url"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Url</label>
                                        <input type="text" id="url" wire:model="jobEditUrl"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="http://padberg.com/" required />
                                        @error('jobEditUrl')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="schedule"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            Schedule</label>
                                        <select id="schedule" wire:model="jobEditSchedule"
                                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option {!! $jobEditSchedule == 'Full Time' ? 'selected' : '' !!} value="Full Time">Full Time</option>
                                            <option {!! $jobEditSchedule == 'Part Time' ? 'selected' : '' !!} value="Part Time">Part Time</option>
                                        </select>
                                        @error('jobEditSchedule')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="featured"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            Feature</label>
                                        <select id="featured" wire:model="jobEditFeature"
                                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option {!! $job->featured == true ? 'selected' : '' !!} value=1>Featured</option>
                                            <option {!! $job->featured == false ? 'selected' : '' !!} value=0>Unfeatured</option>
                                        </select>
                                        @error('jobEditFeature')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            Status</label>
                                        <select id="status" wire:model="jobEditStatus"
                                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option {!! $job->status == true ? 'selected' : '' !!} value=1>Active</option>
                                            <option {!! $job->status == false ? 'selected' : '' !!} value=0>Inactive</option>
                                        </select>
                                        @error('jobEditStatus')
                                            <span class="font-medium mt-2 text-xs text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Update</button>
                            </form>

                        </div>
                        <!--footer-->
                        <div class="p-2 mt-2 flex justify-between">
                            <p>Job - {{ $job->title }}</p>

                            <button wire:click="closeModal()"
                                class="mb-2 md:mb-0 bg-yellow-400 border border-yellow-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-yellow-500">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($isDeleteModalOpen)
            <div
                class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" wire:click="closeDeleteModal"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to
                                delete this job?</h3>
                            <button wire:click="delete" type="button"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button wire:click="closeDeleteModal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif



    </x-dashboard-layout>
</div>
