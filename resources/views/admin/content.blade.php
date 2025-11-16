<x-layout>
    <x-slot:heading>
        Manage Content
    </x-slot:heading>

    <div class="mb-6">
        <a href="/admin/content/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Add New Lesson
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-700 bg-gray-900 text-gray-200 rounded-lg shadow-lg">
            <thead>
            <tr class="bg-gray-800 text-gray-100">
                <th class="border border-gray-700 px-4 py-2">ID</th>
                <th class="border border-gray-700 px-4 py-2">Title</th>
                <th class="border border-gray-700 px-4 py-2">Description</th>
                <th class="border border-gray-700 px-4 py-2">Price</th>
                <th class="border border-gray-700 px-4 py-2">Duration</th>
                <th class="border border-gray-700 px-4 py-2">Enrollments</th>
                <th class="border border-gray-700 px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($lessons as $lesson)
                <tr class="hover:bg-gray-800 transition">
                    <td class="border border-gray-700 px-4 py-2">{{ $lesson->id }}</td>
                    <td class="border border-gray-700 px-4 py-2 font-semibold">{{ $lesson->title }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ Str::limit($lesson->description, 50) }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $lesson->price }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $lesson->duration }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $lesson->enrollments }}</td>
                    <td class="border border-gray-700 px-4 py-2 flex gap-2">
                        <a href="/admin/content/{{ $lesson->id }}/edit"
                           class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded-lg shadow">
                            Edit
                        </a>
                        <form method="POST" action="/admin/content/{{ $lesson->id }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg shadow"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-400">
                        No lessons found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
