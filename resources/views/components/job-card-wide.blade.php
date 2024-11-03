    @props(['job'])

    <div
        class="p-4 bg-black/5 rounded-xl flex gap-x-6 border border-transparent hover:border-blue-800 group transition-colors duration-300">
        <div>
            <x-employer-logo :employer="$job->employer" />
        </div>

        <div class="flex-1 flex flex-col ">
            <a class="self-start text-sm text-gray-700">{{ $job->employer->name }}</a>
            <h3 class="text-xl mt-3 font-bold group-hover:text-blue-800 transition-colors duration-300"><a href="{{ url($job->url) }}" target="_blank">{{ $job->title }}</a>
            </h3>
            <p class="text-sm text-gray-700 mt-auto">{{ $job->schedule }} - {{ $job->salary }} </p>
        </div>


        <div class="space-x-1">
            @foreach ($job->tags as $tag)
                <x-tag :$tag />
            @endforeach
        </div>
    </div>
