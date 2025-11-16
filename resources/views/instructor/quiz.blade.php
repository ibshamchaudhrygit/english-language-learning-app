<x-layout>
    <x-slot:heading>
        Manage Quizzes
    </x-slot:heading>

    <div class="bg-gray-900 text-gray-200 shadow rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Your Quizzes</h2>
            <a href="/teacher/quiz/create"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                + Add New Quiz
            </a>
        </div>

        <table class="w-full border border-gray-700">
            <thead>
            <tr class="bg-gray-800 text-gray-300">
                <th class="border border-gray-700 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-700 px-4 py-2 text-left">Title</th>
                <th class="border border-gray-700 px-4 py-2 text-left">Lesson</th>
                <th class="border border-gray-700 px-4 py-2 text-left">Created At</th>
                <th class="border border-gray-700 px-4 py-2 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($quizzes as $quiz)
                <tr class="hover:bg-gray-800">
                    <td class="border border-gray-700 px-4 py-2">{{ $quiz->id }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $quiz->title }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ optional($quiz->lesson)->title ?? 'N/A' }}</td>
                    <td class="border border-gray-700 px-4 py-2">{{ $quiz->created_at?->format('Y-m-d') }}</td>
                    <td class="border border-gray-700 px-4 py-2 flex gap-2">
                        <a href="/teacher/quiz/{{ $quiz->id }}/edit"
                           class="bg-yellow-500 text-gray-900 px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="/teacher/quiz/{{ $quiz->id }}/delete" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border border-gray-700 px-4 py-2 text-center text-gray-400">
                        No quizzes found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
