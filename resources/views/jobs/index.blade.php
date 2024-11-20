<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <div class="space-y-4">
        {{-- {{dd($jobs)}} --}}
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <h2 class="font-bold text-blue-500 text-lg">{{ $job->title }}</h2>
                {{-- {{ $job->employer->id }} --}}
                <div>
                    <strong>{{ $job['title'] }}:</strong> 
                    <p>Pays {{ $job['salary'] }} per year.</p>
                </div>
            </a>
        @endforeach

        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
