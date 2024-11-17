<?php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Tag;
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
        $jobEditStatus;
    public $jobDeleteID;

    public $isOpen = false;
    public $isDeleteModalOpen = false;
    public $isAddModalOpen = false;

    public $tagInput = '';
    public $selectedTags = [];
    public $suggestedTags;

    public function mount()
    {
        // Example: Get suggested tags
        $this->suggestedTags = Tag::all();
    }

    public function addTag()
    {
        // Prevent adding empty tags
        if (empty($this->tagInput)) {
            return;
        }

        // Assuming $this->selectedTags is an array, and we assign an ID when adding a tag
        $newTag = [
            'id' => count($this->selectedTags) + 1, // You can improve this for a more robust ID system
            'name' => $this->tagInput,
        ];

        // Add the new tag to the selected tags array
        $this->selectedTags[] = $newTag;

        // Clear the input field after adding the tag
        $this->tagInput = '';
    }



    public function selectSuggestedTag($tagId)
    {
        $tag = Tag::find($tagId);
        if ($tag && !in_array($tag->id, array_column($this->selectedTags, 'id'))) {
            $this->selectedTags[] = $tag;
        }
    }


    public function removeTag($tagId)
    {
        // Filter out the tag with the given ID
        $this->selectedTags = array_filter($this->selectedTags, function ($tag) use ($tagId) {
            return $tag['id'] != $tagId; // Ensure you are accessing 'id' properly
        });

        // Reindex the array to reset the keys (optional, but helps if you need a clean array)
        $this->selectedTags = array_values($this->selectedTags);
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
        $job = Job::findOrFail($jobID);

        $this->jobEditTitle = $job->title;
        $this->jobEditSalary = $job->salary;
        $this->jobEditLocation = $job->location;
        $this->jobEditUrl = $job->url;
        $this->jobEditSchedule = $job->schedule;
        $this->jobEditFeature = $job->featured;
        $this->jobEditStatus = $job->status;

        // Get the existing tags
        $this->selectedTags = $job->tags;

        // Get suggested tags excluding the ones already assigned to the job
        $this->suggestedTags = Tag::whereNotIn('id', $job->tags->pluck('id'))->take(7)->get();

        // Clear input for new tag
        $this->tagInput = '';
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

        // Update the job record
        $job = Job::findOrFail($this->jobEditID);
        $job->update(
            [
                'title' =>  $this->jobEditTitle,
                'salary' =>  $this->jobEditSalary,
                'location' => $this->jobEditLocation,
                'url' => $this->jobEditUrl,
                'schedule' => $this->jobEditSchedule,
                'featured' => $this->jobEditFeature,
                'status' => $this->jobEditStatus,
            ]
        );

        // Array to hold tag IDs
        $tagIds = [];

        // Check if each selected tag already exists in the tags table
        foreach ($this->selectedTags as $tagName) {
            // Check if the tag already exists in the database
            $tag = Tag::firstOrCreate(
                ['name' => $tagName], // Look for an existing tag by name
                ['name' => $tagName]  // If not found, create a new tag with the name
            );

            // Add the tag ID to the array
            $tagIds[] = $tag->id;
        }

        // Sync the tags (attach only the new or missing tags, remove any unselected ones)
        $job->tags()->sync($tagIds);

        $this->closeModal();
        session()->flash('success', 'Job updated successfully');
    }



    public function openAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function closeAddModal()
    {
        $this->isAddModalOpen = false;
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
