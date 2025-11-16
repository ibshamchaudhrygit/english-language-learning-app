<x-layout>
    <x-slot:heading>
        Add New Lesson
    </x-slot:heading>

    <form method="POST" action="/admin/content"
          class="bg-gray-900 text-gray-200 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
        @csrf
        <input type="hidden" name="created_by" value="{{Auth::User()->id}}"/>
        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" required
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" rows="4" required
                      class="w-full p-2 bg-gray-800 border border-gray-700 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Image URL</label>
            <input type="text" name="image" required
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Video URL</label>
            <input type="text" name="video_url" required
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Price</label>
            <input type="text" name="price" required
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Duration</label>
            <input type="text" name="duration" required
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Enrollments</label>
            <input type="text" name="enrollments" value="0"
                   class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-white">User (Teacher)</label>
            <select name="user_id" required
                    class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
                <option value="">-- Select a Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                Create Lesson
            </button>
            <a href="/admin/content"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow">
                Cancel
            </a>
        </div>
    </form>
</x-layout>
