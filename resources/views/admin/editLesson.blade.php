<x-layout>
    <x-slot:heading>
        Edit Lesson: {{ $lesson->title }}
    </x-slot:heading>

    <form method="POST" action="/admin/content/{{ $lesson->id }}" class="bg-gray-900 text-gray-200 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
        @csrf
        @method("PATCH")

        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" value="{{ $lesson->title }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full p-2 bg-gray-800 border border-gray-700 rounded">{{ $lesson->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Image URL</label>
            <input type="text" name="image" value="{{ $lesson->image }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Video URL</label>
            <input type="text" name="video_url" value="{{ $lesson->video_url }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Price</label>
            <input type="text" name="price" value="{{ $lesson->price }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Duration</label>
            <input type="text" name="duration" value="{{ $lesson->duration }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Enrollments</label>
            <input type="text" name="enrollments" value="{{ $lesson->enrollments }}"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                Update
            </button>
            <a href="/admin/content" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow">
                Cancel
            </a>
        </div>
    </form>
</x-layout>
