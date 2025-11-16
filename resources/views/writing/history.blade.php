<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">My Writing Submissions</h1>
                <x-button href="/writing">View All Prompts</x-button>
            </div>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($submissions as $submission)
                    <div class="bg-gray-800 shadow-md rounded-lg p-6" x-data="{ open: false }">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-bold text-white">{{ $submission->prompt->title }}</h2>
                            <span class="text-sm text-gray-400">
                                Submitted: {{ $submission->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <p class="text-gray-400 mt-1 text-sm">Prompt: {{ $submission->prompt->prompt }}</p>
                        
                        <div class="mt-4">
                            <!-- Collapsible content -->
                            <div x-show="open" x-transition class="text-gray-300 prose prose-invert max-w-none">
                                {{ $submission->body }}
                            </div>
                            <button @click="open = !open" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium mt-2">
                                <span x-show="!open">Read Submission</span>
                                <span x-show="open">Hide Submission</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 shadow-md rounded-lg p-10 text-center">
                        <h3 class="text-xl font-bold text-white">No Submissions Yet</h3>
                        <p class="text-gray-400 mt-2">Complete a writing prompt to see your history here.</p>
                        <x-button href="/writing" class="mt-4">Find a Prompt</x-button>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>