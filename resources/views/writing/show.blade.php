<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{ $prompt->title }}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <div class="mb-6 border-b border-gray-700 pb-6">
                    <h2 class="text-lg font-semibold text-white mb-2">Your Prompt:</h2>
                    <p class="text-gray-300">{{ $prompt->prompt }}</p>
                </div>
                
                <form method="POST" action="/writing/{{ $prompt->id }}">
                    @csrf
                    <x-form-field>
                        <x-form-label for="body">Your Essay (min. 50 characters)</x-form-label>
                        <x-form-textarea name="body" id="body" rows="15" required>{{ old('body') }}</x-form-textarea>
                        <x-form-error name="body" />
                    </x-form-field>

                    <div class="flex justify-end mt-6">
                        <x-button type="button" href="/writing" class="mr-4 bg-gray-600 hover:bg-gray-500">Cancel</x-button>
                        <x-form-button>Submit Essay</x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>