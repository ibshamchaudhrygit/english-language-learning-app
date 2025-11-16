<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Schedule New Live Session</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <form method="POST" action="/teacher/sessions">
                    @csrf
                    <x-form-field>
                        <x-form-label for="title">Session Title</x-form-label>
                        <x-form-input type="text" name="title" id="title" value="{{ old('title') }}" required/>
                        <x-form-error name="title"/>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="description">Description</x-form-label>
                        <x-form-textarea name="description" id="description" rows="5">{{ old('description') }}</x-form-textarea>
                        <x-form-error name="description"/>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="meeting_url">Meeting URL (Zoom, Google Meet, etc.)</x-form-label>
                        <x-form-input type="url" name="meeting_url" id="meeting_url" value="{{ old('meeting_url') }}" required placeholder="https://..."/>
                        <x-form-error name="meeting_url"/>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="start_time">Start Time</x-form-label>
                        <input type="datetime-local" name="start_time" id="start_time" 
                               value="{{ old('start_time') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 border-gray-600 text-white" required>
                        <x-form-error name="start_time"/>
                    </x-form-field>
                    <div class="flex justify-end mt-6">
                        <x-button type="button" href="/teacher/sessions" class="mr-4 bg-gray-600 hover:bg-gray-500">Cancel</x-button>
                        <x-form-button>Schedule Session</x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>