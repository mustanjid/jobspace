<div>
    {{-- The Master doesn't talk, he acts. --}}
    @foreach ($jobs as $job )
        <p>{{ $job->title }}</p>
    @endforeach
    {{ $jobs->links() }}
    {{-- <h1>{{ $title }}</h1> --}}
</div>
