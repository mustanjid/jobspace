<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class EmpJobManager extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $isActive = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $isOpen = false;
    public $isDeleteModalOpen = false;

    public $jobEditID;
    public $jobEditTitle,
        $jobEditSalary,
        $jobEditLocation,
        $jobEditUrl,
        $jobEditSchedule,
        $jobEditFeature,
        $jobEditStatus,
        $jobEditTags;
    public $jobDeleteID;
    public $suggestedTags = [];
    public $tags = [];

    // public function mount()
    // {
        
    // }

    public function addTag($tagName)
    {
        $tagName = trim($tagName);
        if ($tagName && !in_array($tagName, $this->tags)) {
            $this->tags[] = $tagName;
        }
    }

    public function removeTag($tagName)
    {
        $this->tags = array_filter($this->tags, fn($tag) => $tag !== $tagName);
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == 'ASC' ? ($this->sortDir = 'DESC') : 'ASC';
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
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->jobDeleteID = '';
        $this->resetPage();
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
        $this->suggestedTags = Tag::all()->pluck('name')->toArray();
        $this->tags = Job::findOrFail($jobID)->tags->pluck('name')->toArray();
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

        $job = Job::findOrFail($this->jobEditID);

        $job->update(
            [
                'title' =>  $this->jobEditTitle,
                'salary' =>  $this->jobEditSalary,
                'location' =>           $this->jobEditLocation,
                'url'    =>       $this->jobEditUrl,
                'schedule'  =>          $this->jobEditSchedule,
            ]
        );
        $tagIds = [];
        foreach ($this->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $job->tags()->sync($tagIds);

        $this->closeModal();
        $this->resetPage();
        request()->session()->flash('success', 'Job updated successfully');
       
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        $empjobs = Job::with('employer', 'tags')
            ->where('employer_id', Auth::user()->employer->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('salary', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%')
                        ->orWhere('tags', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->isActive !== '', function ($query) {
                $query->where('status', $this->isActive);
            })
            ->when($this->sortBy !== 'name', function ($query) {
                // Sort by other job columns
                $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->paginate(10);


        return view('livewire.emp-job-manager', ['empjobs' => $empjobs]);
    }
}
