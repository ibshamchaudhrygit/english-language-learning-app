<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">Forum Threads</h1>
                <x-button href="/messages/create">Start New Thread</x-button>
            </div>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($messages as $thread)
                    <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold text-white hover:text-indigo-400">
                                    <a href="/messages/{{ $thread->id }}">{{ $thread->title }}</a>
                                </h2>
                                <span class="text-sm font-medium text-gray-300 bg-gray-700 px-3 py-1 rounded-full">
                                    {{ $thread->replies->count() }} {{ Str::plural('Reply', $thread->replies->count()) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-400 mt-2">
                                Started by <span class="font-medium text-gray-300">{{ $thread->user->name }}</span>
                                on {{ $thread->created_at->format('M d, Y') }}
                            </div>
                            <p class="text-gray-300 mt-3">{{ Str::limit($thread->body, 150) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 shadow-md rounded-lg p-10 text-center">
                        <h3 class="text-xl font-bold text-white">No Threads Yet</h3>
                        <p class="text-gray-400 mt-2">Be the first to start a conversation!</p>
                        <x-button href="/messages/create" class="mt-4">Start New Thread</x-button>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>