<x-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-center mb-8">My Badges</h1>

        @if($badges->isEmpty())
            <div class="text-center bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-700">You have not earned any badges yet.</p>
                <x-button href="/lessons" class="mt-4">Start Learning</x-button>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($badges as $badge)
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <img src="{{ $badge->icon_url ?? 'https://placehold.co/100x100/E2E8F0/AAAAAA?text=Badge' }}" alt="{{ $badge->name }}" class="w-24 h-24 mx-auto rounded-full mb-2">
                        <h3 class="font-bold text-gray-800">{{ $badge->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $badge->description }}</p>
                        <p class="text-xs text-gray-400 mt-2">Earned: {{ $badge->pivot->earned_at->format('M d, Y') }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>