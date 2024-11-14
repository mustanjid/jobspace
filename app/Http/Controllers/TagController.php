<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        $jobs = $tag->jobs()
            ->where('status', 1) // Active jobs
            ->whereHas('employer', function ($query) {
                $query->where('status', 1); // Active employer
            })
            ->get();

        return view('result', ['jobs' =>  $jobs]);
    }
}
