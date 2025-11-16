<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Upcoming Live Sessions</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($sessions as $session)
                    <div class="bg-gray-800 shadow-md rounded-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white">{{ $session->title }}</h2>
                            <p class="text-sm text-gray-400 mt-1">
                                Hosted by <span class="font-medium text-gray-300">{{ $session->user->name }}</span>
                            </p>
                            <p class="text-gray-300 mt-3">{{ $session->description }}</p>
                            <p class="text-lg font-semibold text-indigo-400 mt-2">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ $session->start_time->format('D, M j, Y \a\t h:i A') }}
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-6">
                            <x-button href="{{ $session->meeting_url }}" target="_blank" rel="noopener noreferrer">
                                Join Session
                                <i class="fas fa-external-link-alt ml-2"></i>
                            </x-button>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 shadow-md rounded-lg p-10 text-center">
                        <h3 class="text-xl font-bold text-white">No Upcoming Sessions</h3>
                        <p class="text-gray-400 mt-2">Check back soon for new live sessions!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>