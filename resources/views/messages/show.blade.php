<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{ $message->title }}</h1>
            <p class="text-sm text-gray-400 mt-1">
                Started by {{ $message->user->name }} on {{ $message->created_at->format('M d, Y') }}
            </p>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="space-y-8">
                
                <!-- Original Post -->
                <div class="bg-gray-800 shadow-md rounded-lg p-6 border border-indigo-500">
                    <div class="flex items-start space-x-4">
                        <img class="h-10 w-10 rounded-full" src="https://placehold.co/256x256/E0E7FF/4F46E5?text={{ substr($message->user->name, 0, 1) }}" alt="">
                        <div class="flex-1">
                            <p class="font-semibold text-white">{{ $message->user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-gray-300 prose prose-invert max-w-none">
                        {{ $message->body }}
                    </div>
                </div>

                <!-- Replies -->
                <h2 class="text-2xl font-bold text-white">Replies</h2>
                <div class="space-y-6">
                    @forelse ($message->replies as $reply)
                        <div class="bg-gray-800 shadow-md rounded-lg p-6">
                            <div class="flex items-start space-x-4">
                                <img class="h-10 w-10 rounded-full" src="https://placehold.co/256x256/E0E7FF/4F46E5?text={{ substr($reply->user->name, 0, 1) }}" alt="">
                                <div class="flex-1">
                                    <p class="font-semibold text-white">{{ $reply->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="mt-4 text-gray-300">
                                {{ $reply->body }}
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-800 shadow-md rounded-lg p-6 text-center">
                            <p class="text-gray-400">No replies yet. Be the first to respond!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Post a Reply Form -->
                <div class="bg-gray-800 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Post a Reply</h3>
                    <form method="POST" action="/messages/{{ $message->id }}/reply">
                        @csrf
                        <div>
                            <label for="body" class="sr-only">Reply</label>
                            <textarea id="body" name="body" rows="5" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Type your reply..."></textarea>
                        </div>
                        <div class="mt-4">
                            <x-form-button>Post Reply</x-form-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
</x-layout>