<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Livewire\WithPagination;

class UserJobView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $isTag = '';
    public $isStatus = '';

    public function resetFields()
    {
        $this->search = '';
        $this->perPage = 5;
        $this->isTag = '';
        $this->isStatus = '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $jobs = Job::latest()
        ->with(['employer', 'tags'])
        ->where('status', 1) // Ensure only active jobs
        ->whereHas('employer', function ($query) {
            $query->where('status', 1); // Ensure only active employers
        })
            ->when(
                $this->search !== '',
                function ($query) {
                    $query->where(function ($query) {
                        $query->where('title', 'like', '%' . $this->search . '%')
                            ->orWhere('location', 'like', '%' . $this->search . '%')
                            ->orWhereHas('employer', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            });
                    });
                }
            )
            ->when(
                $this->isStatus !== '',
                function ($query) {
                    $query->where('featured', $this->isStatus);
                }
            )
            ->when(
                $this->isTag !== '',
                function ($query) {
                    $query->whereHas('tags', function ($query) {
                        $query->where('tags.id', $this->isTag); // Filter by selected tag ID
                    });
                }
            )
            ->paginate($this->perPage);


        return view('livewire.user-job-view', ['jobs' => $jobs]);
    }
}
