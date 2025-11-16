<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Edit Speaking Phrase</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-3xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md p-6">
                <form method="POST" action="/admin/phrases/{{ $phrase->id }}">
                    @csrf
                    @method('PATCH')
                    <x-form-field>
                        <x-form-label for="phrase">Phrase</x-form-label>
                        <x-form-textarea name="phrase" id="phrase" rows="3" required>{{ old('phrase', $phrase->phrase) }}</x-form-textarea>
                        <x-form-error name="phrase"/>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="category">Category</x-form-label>
                        <x-form-input type="text" name="category" id="category" value="{{ old('category', $phrase->category) }}" required/>
                        <x-form-error name="category"/>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="skill_level">Skill Level</x-form-label>
                        <select name="skill_level" id="skill_level" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-700 border-gray-600 text-white">
                            <option value="beginner" {{ old('skill_level', $phrase->skill_level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('skill_level', $phrase->skill_level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('skill_level', $phrase->skill_level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        <x-form-error name="skill_level"/>
                    </x-form-field>
                    <div class="flex justify-end mt-6">
                        <x-button type="button" href="/admin/phrases" class="mr-4 bg-gray-600 hover:bg-gray-500">Cancel</x-button>
                        <x-form-button>Update Phrase</x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>