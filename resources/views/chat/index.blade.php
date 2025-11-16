<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Peer Chat</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-white mb-4">Start a Conversation</h2>
                <p class="text-gray-400 mb-6">Select a student to start or continue a private chat.</p>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($users as $user)
                        <a href="/chat/{{ $user->id }}" class="block p-4 bg-gray-700 rounded-lg text-center hover:bg-gray-600 transition-colors">
                            <img class="h-16 w-16 rounded-full mx-auto" src="https://placehold.co/256x256/E0E7FF/4F46E5?text={{ substr($user->name, 0, 1) }}" alt="">
                            <p class="mt-2 font-medium text-white">{{ $user->name }}</p>
                        </a>
                    @empty
                        <p class="text-gray-400 col-span-full text-center">There are no other students to chat with right now.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</x-layout>