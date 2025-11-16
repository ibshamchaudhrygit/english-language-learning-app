<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">Writing Practice</h1>
                <x-button href="/my-writing">My Submissions</x-button>
            </div>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($prompts as $prompt)
                    <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold text-white">{{ $prompt->title }}</h2>
                                <span class="text-sm font-semibold 
                                    @switch($prompt->skill_level)
                                        @case('beginner') bg-green-800 text-green-200 @break
                                        @case('intermediate') bg-yellow-800 text-yellow-200 @break
                                        @case('advanced') bg-red-800 text-red-200 @break
                                    @endswitch
                                    px-3 py-1 rounded-full">{{ ucfirst($prompt->skill_level) }}</span>
                            </div>
                            <p class="text-gray-300 mt-3">{{ $prompt->prompt }}</p>
                            <div class="mt-4">
                                <x-button href="/writing/{{ $prompt->id }}">Start Writing</x-button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 shadow-md rounded-lg p-10 text-center">
                        <h3 class="text-xl font-bold text-white">No Writing Prompts Yet</h3>
                        <p class="text-gray-400 mt-2">Check back soon for new writing exercises!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>