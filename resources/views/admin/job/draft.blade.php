{{-- @if ($isOpen)
            <div
                class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <div class="">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <form>
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                                        </label>
                                        <input type="text" id="title"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Web Developer" required />
                                        <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span
                                                class="font-medium"></span></p>
                                    </div>

                                    <div>
                                        <label for="salary"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                        <input type="text" id="salary"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="40,000 - 50,000 Tk" required />
                                    </div>

                                    <div>
                                        <label for="location"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                        <input type="text" id="location"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Dhaka, Bangladesh" required />
                                    </div>

                                    <div>
                                        <label for="url"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Url</label>
                                        <input type="text" id="url"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="http://padberg.com/" required />
                                    </div>

                                    <div>
                                        <label for="schedule"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule</label>
                                        <select id="schedule"
                                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected>Select an option</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="featured"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Featured</label>
                                        <select id="featured"
                                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected>Select an option</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                        <select id="status"
                                            class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                            <option selected>Select an option</option>
                                            <option value="US">United States</option>
                                            <option value="CA">Canada</option>
                                        </select>
                                    </div>

                                </div>

                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Update</button>
                            </form>

                        </div>
                        <!--footer-->
                        <div class="p-2 mt-2 flex justify-between">
                            <button
                                class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                Cancel
                            </button>

                            <button
                                class="mb-2 md:mb-0 bg-yellow-400 border border-yellow-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-yellow-500">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
        @endif --}}

{{-- 
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
                    @foreach ($jobs as $job)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $job->employer->name }}</td>
                            <td class="px-6 py-4">{{ $job->title }}</td>
                            <td class="px-6 py-4">{{ $job->salary }}</td>
                            <td class="px-6 py-4">{{ $job->location }}</td>
                            <td class="px-6 py-4">{{ $job->schedule }}</td>
                            <td class="px-6 py-4">{{ $job->featured ? 'Featured' : 'Unfeatured' }}</td>
                            <td class="px-6 py-4">{{ $job->status ? 'Active' : 'Inactive' }}</td>
                            <td class="flex justify-between items-center gap-2 px-6 py-4">

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div> --}}

        <?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class JobView extends Component
{
    use WithPagination;

    // public $jobs, $job_id, $title, $salary, $location, $url, $schedule, $featured, $status, $search;
    // public $isOpen = false; // Track modal state for create/edit form
    // protected $rules = [
    //     'title' => 'required',
    //     'salary' => 'required',
    //     'location' => 'required',
    //     'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
    //     'url' => ['required', 'active_url'],
    //     'featured' => ['required', Rule::in(['Featured', 'Uneatured'])],
    //     'status' => ['required', Rule::in(['Active', 'Inactive'])],
    // ];
    //public $userJobs = Job::all();

    public function render()
    {
        //$jobs = Job::where('title', 'like', '%' . $this->search . '%')->paginate(10);

        // $jobs = Job::query()
        //     ->when(!empty($this->search), function ($query) {
        //         $query->where('title', 'like', '%' . $this->search . '%');
        //     })
        //     ->paginate(10); // Display 10 tasks per page

        // $jobs = Job::latest()->with('employer')
        // ->paginate(10);

        $jobs = Job::latest()->with('employer')
            ->paginate(10);;

        return view('livewire.job-view', ['jobs' => $jobs]);
    }

    // public function resetInputFields()
    // {
    //     $this->title = '';
    //     $this->salary = '';
    //     $this->location = '';
    //     $this->url = '';
    //     $this->schedule = '';
    //     $this->featured = '';
    //     $this->status = '';
    //     $this->search = '';
    // }

    // public function openModal()
    // {
    //     $this->resetInputFields();
    //     $this->isOpen = true;
    // }

    // public function closeModal()
    // {
    //     $this->isOpen = false;
    // }

    // public function store()
    // {
    //     $this->validate();

    //     $featuredVal = 0;
    //     $status = 0;

    //     if($this->featured === 'Featured'){
    //         $featuredVal = 1;
    //     }

    //     if ($this->status === 'Active') {
    //         $status = 1;
    //     }

    //     Job::updateOrCreate(['id' => $this->job_id], [
    //         'title' => $this->title,
    //         'salary' => $this->salary,
    //         'location' => $this->location,
    //         'url' => $this->url,
    //         'schedule' => $this->schedule,
    //         'featured' => $featuredVal,
    //         'status' => $status,
    //     ]);

    //     session()->flash('message', $this->job_id ? 'Job Updated Successfully!' : 'Job Created Successfully!');

    //     $this->closeModal();
    //     $this->resetInputFields();
    // }

    // public function edit($id)
    // {
    //     $job = Job::findOrFail($id);
    //     $this->job_id = $id;
    //     $this->title = $job->title;
    //     $this->salary = $job->salary;
    //     $this->location = $job->location;
    //     $this->url = $job->url;
    //     $this->schedule = $job->schedule;
    //     $this->featured = $job->featured;
    //     $this->status = $job->status;

    //     $this->isOpen = true; // Open modal with existing data
    // }

    // public function delete($id)
    // {
    //     Job::find($id)->delete();
    //     session()->flash('message', 'Job Deleted Successfully!');
    // }
    
}
