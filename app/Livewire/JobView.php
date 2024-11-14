<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class JobView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $isActive = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $jobEditID;
    public $jobEditTitle,
    $jobEditSalary,
    $jobEditLocation,
    $jobEditUrl,
    $jobEditSchedule,
    $jobEditFeature,
    $jobEditEmployer,
    $jobTags,
    $jobEditStatus;
    public $jobDeleteID;

    public $isOpen = false;
    public $isDeleteModalOpen = false;
    public $isAddModalOpen = false;

    public function openAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? $this->sortDir = "DESC" : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function resetFields()
    {
        $this->search = '';
        $this->perPage = 5;
        $this->isActive = '';
        $this->sortBy = 'created_at';
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->jobDeleteID = '';
    }
    public function openDeleteModal($jobID)
    {
        $this->isDeleteModalOpen = true;
        $this->jobDeleteID = $jobID;
    }

    public function delete()
    {
        $job = Job::findOrFail($this->jobDeleteID);
        $job->delete();
        $this->closeDeleteModal();
        session()->flash('failure', 'Job deleted !');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset('jobEditTitle');
    }


    public function edit($jobID)
    {
        $this->isOpen = true;
        $this->jobEditID = $jobID;
        $this->jobEditTitle = Job::findOrFail($jobID)->title;
        $this->jobEditSalary = Job::findOrFail($jobID)->salary;
        $this->jobEditLocation = Job::findOrFail($jobID)->location;
        $this->jobEditUrl = Job::findOrFail($jobID)->url;
        $this->jobEditSchedule = Job::findOrFail($jobID)->schedule;
        $this->jobEditFeature = Job::findOrFail($jobID)->featured;
        $this->jobEditStatus = Job::findOrFail($jobID)->status;
    }

    public function update()
    {
        $this->validate(
            [
                'jobEditTitle' => ['required'],
                'jobEditSalary' => ['required'],
                'jobEditLocation' => ['required'],
                'jobEditUrl' => ['required', 'active_url'],
                'jobEditSchedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
                'jobEditFeature' => ['required'],
                'jobEditStatus' => ['required'],
            ]
        );

        Job::findOrFail($this->jobEditID)->update(
            [
                'title' =>  $this->jobEditTitle,
                'salary' =>  $this->jobEditSalary,
                'location' =>           $this->jobEditLocation,
                'url'    =>       $this->jobEditUrl,
                'schedule'  =>          $this->jobEditSchedule,
                'featured'    =>       $this->jobEditFeature,
                'status'    =>       $this->jobEditStatus,
            ]
        );

        $this->closeModal();
       session()->flash('success', 'Job updated successfully');
    }

    public function add()
    {
        $this->validate(
            [
                'jobEditTitle' => ['required'],
                'jobEditSalary' => ['required'],
                'jobEditLocation' => ['required'],
                'jobEditUrl' => ['required', 'active_url'],
                'jobEditSchedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
                'jobEditFeature' => ['required'],
                'jobEditStatus' => ['required'],
                'jobEditEmployer' => ['required'],
                'jobTags' => ['required'],
            ]
        );

        Job::create(
            [
                'employer_id' =>  $this->jobEditTitle,
                'title' =>  $this->jobEditTitle,
                'salary' =>  $this->jobEditSalary,
                'location' =>           $this->jobEditLocation,
                'url'    =>       $this->jobEditUrl,
                'schedule'  =>          $this->jobEditSchedule,
                'featured'    =>       $this->jobEditFeature,
                'status'    =>       $this->jobEditStatus,
            ]
        );

        $this->closeModal();
        session()->flash('success', 'Job updated successfully');
    }

    public function render()
    {
        $jobs = Job::with('employer')
            ->search($this->search)
            ->when($this->isActive !== '', function ($query) {
                $query->where('status', $this->isActive);
            })->when($this->sortBy === 'name', function ($query) {
                // Join employers table for sorting by employer name
                $query->Join('employers', 'jobs.employer_id', '=', 'employers.id')
                    ->orderBy($this->sortBy, $this->sortDir);
            })
            ->when($this->sortBy !== 'name', function ($query) {
                // Sort by other job columns
                $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->paginate($this->perPage);

        return view('livewire.job-view', ['jobs' => $jobs]);
    }
}
