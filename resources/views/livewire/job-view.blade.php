<div>
    <x-dashboard-layout>

        @if (session('success'))
            <div id="alert-3"
                class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
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
                class="mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
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

        @php
            $permissionAddJob = App\Models\PositionPermission::getPermission('add job', Auth::user()->position_id);
            $permissionEditJob = App\Models\PositionPermission::getPermission('update job', Auth::user()->position_id);
            $permissionDeleteJob = App\Models\PositionPermission::getPermission(
                'delete job',
                Auth::user()->position_id,
            );
        @endphp

        <div class="mx-auto max-w-screen-xl px-4 lg:px-1"">
            <h1 class="p-2 text-center text-sm">All Jobs</h1>
            <!-- Start coding here -->
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex p-4">
                    <button type="button" wire:click="openAddModal"
                        class="rounded-lg bg-blue-700 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        a Job</button>
                </div>
                <div class="d flex items-center justify-between p-4">
                    <div class="flex w-2/3 justify-between">
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="focus:ring-primary-500 focus:border-primary-500 block w-1/2 rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900"
                                placeholder="Search by title, employer" required="">
                        </div>
                        <button type="button" wire:click="resetFields()"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-1/5 rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 hover:bg-gray-400">Reset
                            Filters</button>
                    </div>

                    <div class="flex space-x-3">
                        <div class="flex items-center space-x-3">
                            <label class="w-40 text-sm font-medium text-gray-900">Status Type :</label>
                            <select wire:model.live.debounce.300ms="isActive"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
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
                                        class="whitespace-nowrap px-2 py-2 font-medium text-gray-900 dark:text-white">
                                        {{ $job->employer->name }}</th>
                                    <td class="px-2 py-2"> {{ $job->title }}</td>
                                    <td class="px-2 py-2"> {{ $job->salary }}</td>
                                    <td class="px-4 py-3"> {{ $job->location }}</td>
                                    <td class="px-2 py-2"> {{ $job->url }}</td>
                                    <td class="px-2 py-2"> {{ $job->schedule }}</td>
                                    @if ($job->featured)
                                        <td class="px-4 py-3 text-green-500">Featured</td>
                                    @else
                                        <td class="px-2 py-2 text-red-500">Unfeatured</td>
                                    @endif
                                    @if ($job->status)
                                        <td class="px-2 py-2 text-green-500">Active</td>
                                    @else
                                        <td class="px-2 py-2 text-red-500">Inactive</td>
                                    @endif
                                    @if (!empty($permissionEditJob))
                                        <td class="px-2 py-2">
                                            <button wire:click="edit({{ $job->id }})"
                                                class="rounded text-sm font-semibold text-teal-500 hover:text-teal-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>
                                    @endif
                                    @if (!empty($permissionDeleteJob))
                                        <button wire:click="openDeleteModal({{ $job->id }})"
                                            class="mr-1 rounded text-sm font-semibold text-red-500 hover:text-teal-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="h-5 w-5">
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

                <div class="flex justify-between px-3 py-4">
                    <div class="flex">
                        <div class="mb-3 flex items-center space-x-4">
                            <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                            <select wire:model.live='perPage'
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
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


        @if ($isAddModalOpen)
            <div
                class="min-w-screen animated fadeIn faster fixed inset-0 left-0 top-0 z-50 flex h-screen items-center justify-center bg-cover bg-center bg-no-repeat outline-none focus:outline-none">
                <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
                <div class="relative mx-auto my-auto w-full max-w-lg rounded-xl bg-white p-5 shadow-lg">
                    <!--content-->
                    <p>Job Add Form</p>
                    <div class="">
                        <!--body-->
                        <div class="flex-auto justify-center p-5 text-center">
                            <form wire:submit="add">
                                @csrf
                                <div class="mb-6 grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="title"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title
                                        </label>
                                        <input type="text" wire:model="jobEditTitle" id="title"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Web Developer" />
                                        @error('jobEditTitle')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div>
                                        <label for="salary"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                        <input type="text" id="salary" wire:model="jobEditSalary"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="40,000 - 50,000 Tk" required />
                                        @error('jobEditSalary')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="location"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                        <input type="text" id="location" wire:model="jobEditLocation"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Dhaka, Bangladesh" required />
                                        @error('jobEditLocation')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="url"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Url</label>
                                        <input type="text" id="url" wire:model="jobEditUrl"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="http://padberg.com/" required />
                                        @error('jobEditUrl')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="schedule"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Schedule</label>
                                        <select id="schedule" wire:model="jobEditSchedule"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option value="select">Select</option>
                                            <option value="Full Time">Full
                                                Time</option>
                                            <option value="Part Time">Part
                                                Time</option>
                                        </select>
                                        @error('jobEditSchedule')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="featured"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Feature</label>
                                        <select id="featured" wire:model="jobEditFeature"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option value="select">Select</option>
                                            <option value=1>Featured</option>
                                            <option value=0>Unfeatured</option>
                                        </select>
                                        @error('jobEditFeature')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Status</label>
                                        <select id="status" wire:model="jobEditStatus"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option value="select">Select</option>
                                            <option value=1>Active</option>
                                            <option value=0>Inactive</option>
                                        </select>
                                        @error('jobEditStatus')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="employer"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Employer</label>
                                            <select id="employer" wire:model="jobEditEmployer"
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="select">
                                            Select</option>
                                        @foreach (\App\Models\Employer::all() as $employer)
                                            <option value="{{ $employer->id }}">
                                                {{ $employer->name }}</option>
                                        @endforeach
                                        </select>
                                        @error('jobEditEmployer')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="tags" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                        <input type="text" id="tags" wire:model="jobTags"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Leadership, Management" required />
                                        @error('jobEditLocation')
                                        <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:w-auto">Add</button>
                            </form>

                        </div>
                        <!--footer-->
                        <div class="mt-2 flex justify-between p-2">
                            <p>Jobspace</p>

                            <button wire:click="closeModal()"
                                class="mb-2 rounded-full border border-yellow-400 bg-yellow-400 px-5 py-2 text-sm font-medium tracking-wider text-white shadow-sm hover:bg-yellow-500 hover:shadow-lg md:mb-0">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($isOpen)
            <div
                class="min-w-screen animated fadeIn faster fixed inset-0 left-0 top-0 z-50 flex h-screen items-center justify-center bg-cover bg-center bg-no-repeat outline-none focus:outline-none">
                <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
                <div class="relative mx-auto my-auto w-full max-w-lg rounded-xl bg-white p-5 shadow-lg">
                    <!--content-->
                    <p>Edit Job Form</p>
                    <div class="">
                        <!--body-->
                        <div class="flex-auto justify-center p-5 text-center">
                            <form wire:submit="update">
                                @csrf
                                <div class="mb-6 grid gap-6 md:grid-cols-2">
                                    <div>
                                        <label for="title"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title
                                        </label>
                                        <input type="text" wire:model="jobEditTitle" id="title"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Web Developer" />
                                        @error('jobEditTitle')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div>
                                        <label for="salary"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                        <input type="text" id="salary" wire:model="jobEditSalary"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="40,000 - 50,000 Tk" required />
                                        @error('jobEditSalary')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="location"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                        <input type="text" id="location" wire:model="jobEditLocation"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Dhaka, Bangladesh" required />
                                        @error('jobEditLocation')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="url"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Url</label>
                                        <input type="text" id="url" wire:model="jobEditUrl"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="http://padberg.com/" required />
                                        @error('jobEditUrl')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="schedule"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Schedule</label>
                                        <select id="schedule" wire:model="jobEditSchedule"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option {!! $jobEditSchedule == 'Full Time' ? 'selected' : '' !!} value="Full Time">Full Time</option>
                                            <option {!! $jobEditSchedule == 'Part Time' ? 'selected' : '' !!} value="Part Time">Part Time</option>
                                        </select>
                                        @error('jobEditSchedule')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="featured"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Feature</label>
                                        <select id="featured" wire:model="jobEditFeature"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option {!! $job->featured == true ? 'selected' : '' !!} value=1>Featured</option>
                                            <option {!! $job->featured == false ? 'selected' : '' !!} value=0>Unfeatured</option>
                                        </select>
                                        @error('jobEditFeature')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                            Status</label>
                                        <select id="status" wire:model="jobEditStatus"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                            <option {!! $job->status == true ? 'selected' : '' !!} value=1>Active</option>
                                            <option {!! $job->status == false ? 'selected' : '' !!} value=0>Inactive</option>
                                        </select>
                                        @error('jobEditStatus')
                                            <span class="mt-2 text-xs font-medium text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit"
                                    class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 sm:w-auto">Update</button>
                            </form>

                        </div>
                        <!--footer-->
                        <div class="mt-2 flex justify-between p-2">
                            <p>Job - {{ $job->title }}</p>

                            <button wire:click="closeModal()"
                                class="mb-2 rounded-full border border-yellow-400 bg-yellow-400 px-5 py-2 text-sm font-medium tracking-wider text-white shadow-sm hover:bg-yellow-500 hover:shadow-lg md:mb-0">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($isDeleteModalOpen)
            <div
                class="min-w-screen animated fadeIn faster fixed inset-0 left-0 top-0 z-50 flex h-screen items-center justify-center bg-cover bg-center bg-no-repeat outline-none focus:outline-none">
                <div class="absolute inset-0 z-0 bg-black opacity-80"></div>
                <div class="relative max-h-full w-full max-w-md p-4">
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <button type="button" wire:click="closeDeleteModal"
                            class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="popup-modal">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 text-center md:p-5">
                            <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to
                                delete this job?</h3>
                            <button wire:click="delete" type="button"
                                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
                                Yes, I'm sure
                            </button>
                            <button wire:click="closeDeleteModal" type="button"
                                class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">No,
                                cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif



    </x-dashboard-layout>
</div>
