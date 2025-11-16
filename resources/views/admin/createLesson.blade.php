<x-layout> {{-- UPDATED: Correct layout component --}}
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        {{-- UPDATED: Swapped bg-white for bg-gray-800, max-w-2xl for 3xl --}}
        <div class="max-w-3xl mx-auto p-6 bg-gray-800 rounded-lg shadow-md mt-10">
            <h1 class="text-2xl font-bold text-white mb-6">Create New Lesson</h1> {{-- UPDATED: text-white --}}

            <form method="POST" action="/admin/content">
                @csrf
                
                <x-form-field>
                    <x-form-label for="title" class="text-gray-300">Title</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to input --}}
                    <x-form-input type="text" name="title" id="title" value="{{ old('title') }}" required class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500"/>
                    <x-form-error name="title"/>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="description" class="text-gray-300">Description</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to textarea --}}
                    <x-form-textarea name="description" id="description" required class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500">{{ old('description') }}</x-form-textarea>
                    <x-form-error name="description"/>
                </x-form-field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-field>
                        <x-form-label for="skill_level" class="text-gray-300">Skill Level</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                        {{-- UPDATED: Added dark mode classes to select --}}
                        <select name="skill_level" id="skill_level" class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="beginner" {{ old('skill_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('skill_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('skill_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        <x-form-error name="skill_level"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="category" class="text-gray-300">Category</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                        {{-- UPDATED: Added dark mode classes to input --}}
                        <x-form-input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="e.g., Grammar, Vocabulary" class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 placeholder-gray-400"/>
                        <x-form-error name="category"/>
                    </x-form-field>
                </div>

                <x-form-field>
                    <x-form-label for="image" class="text-gray-300">Image URL</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to input --}}
                    <x-form-input type="text" name="image" id="image" value="{{ old('image') }}" placeholder="https://..." class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 placeholder-gray-400"/>
                    <x-form-error name="image"/>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="video_url" class="text-gray-300">Video URL</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to input --}}
                    <x-form-input type="text" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/..." class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 placeholder-gray-400"/>
                    <x-form-error name="video_url"/>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="audio_url" class="text-gray-300">Audio URL</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to input --}}
                    <x-form-input type="text" name="audio_url" id="audio_url" value="{{ old('audio_url') }}" placeholder="https://.../audio.mp3" class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 placeholder-gray-400"/>
                    <x-form-error name="audio_url"/>
                </x-form-field>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-form-field>
                        <x-form-label for="price" class="text-gray-300">Price</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                        {{-- UPDATED: Added dark mode classes to input --}}
                        <x-form-input type="number" name="price" id="price" value="{{ old('price', 0) }}" class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500"/>
                        <x-form-error name="price"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="duration" class="text-gray-300">Duration</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                        {{-- UPDATED: Added dark mode classes to input --}}
                        <x-form-input type="text" name="duration" id="duration" value="{{ old('duration') }}" placeholder="e.g., 2h 30m" class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500 placeholder-gray-400"/>
                        <x-form-error name="duration"/>
                    </x-form-field>
                    
                    <x-form-field>
                        <x-form-label for="enrollments" class="text-gray-300">Enrollments</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                        {{-- UPDATED: Added dark mode classes to input --}}
                        <x-form-input type="number" name="enrollments" id="enrollments" value="{{ old('enrollments', 0) }}" class="bg-gray-700 text-white border-gray-600 focus:ring-indigo-500"/>
                        <x-form-error name="enrollments"/>
                    </x-form-field>
                </div>

                <x-form-field>
                    <x-form-label for="user_id" class="text-gray-300">Teacher</x-form-label> {{-- UPDATED: Added text-gray-300 --}}
                    {{-- UPDATED: Added dark mode classes to select --}}
                    <select name="user_id" id="user_id" class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-form-error name="user_id"/>
                </x-form-field>

                <div class="flex justify-end mt-6">
                    {{-- UPDATED: Dark-mode friendly cancel button --}}
                    <x-button type="button" href="/admin/content" class="mr-4 bg-gray-600 hover:bg-gray-500 text-white">Cancel</x-button>
                    <x-form-button>Create Lesson</x-form-button>
                </div>
            </form>
        </div>
    </div>
</x-layout> {{-- UPDATED: Correct layout component --}}