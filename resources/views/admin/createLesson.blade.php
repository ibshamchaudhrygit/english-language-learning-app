<x-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Create New Lesson</h1>

        <form method="POST" action="/admin/content">
            @csrf
            
            <x-form-field>
                <x-form-label for="title">Title</x-form-label>
                <x-form-input type="text" name="title" id="title" value="{{ old('title') }}" required/>
                <x-form-error name="title"/>
            </x-form-field>

            <x-form-field>
                <x-form-label for="description">Description</x-form-label>
                <x-form-textarea name="description" id="description" required>{{ old('description') }}</x-form-textarea>
                <x-form-error name="description"/>
            </x-form-field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form-field>
                    <x-form-label for="skill_level">Skill Level</x-form-label>
                    <select name="skill_level" id="skill_level" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="beginner" {{ old('skill_level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('skill_level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('skill_level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    <x-form-error name="skill_level"/>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="category">Category</x-form-label>
                    <x-form-input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="e.g., Grammar, Vocabulary"/>
                    <x-form-error name="category"/>
                </x-form-field>
            </div>

            <x-form-field>
                <x-form-label for="image">Image URL</x-form-label>
                <x-form-input type="text" name="image" id="image" value="{{ old('image') }}" placeholder="https://..."/>
                <x-form-error name="image"/>
            </x-form-field>

            <x-form-field>
                <x-form-label for="video_url">Video URL</x-form-label>
                <x-form-input type="text" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/..."/>
                <x-form-error name="video_url"/>
            </x-form-field>

            <x-form-field>
                <x-form-label for="audio_url">Audio URL</x-form-label>
                <x-form-input type="text" name="audio_url" id="audio_url" value="{{ old('audio_url') }}" placeholder="https://.../audio.mp3"/>
                <x-form-error name="audio_url"/>
            </x-form-field>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <x-form-field>
                    <x-form-label for="price">Price</x-form-label>
                    <x-form-input type="number" name="price" id="price" value="{{ old('price', 0) }}"/>
                    <x-form-error name="price"/>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="duration">Duration</x-form-label>
                    <x-form-input type="text" name="duration" id="duration" value="{{ old('duration') }}" placeholder="e.g., 2h 30m"/>
                    <x-form-error name="duration"/>
                </x-form-field>
                
                <x-form-field>
                    <x-form-label for="enrollments">Enrollments</x-form-label>
                    <x-form-input type="number" name="enrollments" id="enrollments" value="{{ old('enrollments', 0) }}"/>
                    <x-form-error name="enrollments"/>
                </x-form-field>
            </div>

            <x-form-field>
                <x-form-label for="user_id">Teacher</x-form-label>
                <select name="user_id" id="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                <x-form-error name="user_id"/>
            </x-form-field>

            <div class="flex justify-end mt-6">
                <x-button type="button" href="/admin/content" class="mr-4 bg-gray-500 hover:bg-gray-700">Cancel</x-button>
                <x-form-button>Create Lesson</x-form-button>
            </div>
        </form>
    </div>
</x-layout>