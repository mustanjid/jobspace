<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;
use Livewire\WithPagination;

class TestLiveWire extends Component
{
    use WithPagination;
    public function render()
    {
        //$jobs = Job::findOrFail(1);
        $jobs = Job::latest()->with('employer')->paginate(10);
        return view('livewire.test-live-wire', ['jobs' => $jobs ]);
    }
}
