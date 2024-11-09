<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(3)->create();
        Job::factory(count: 10)->hasAttached($tags)->create(new Sequence(
            ['featured' => false, 'schedule' => 'Full Time'],
            ['featured' => true, 'schedule' => 'Full Time']
        ));
    }
}