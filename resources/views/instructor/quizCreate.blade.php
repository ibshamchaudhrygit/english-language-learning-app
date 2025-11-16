<!-- resources/views/teacher/quizCreate.blade.php -->
<x-layout>
    <x-slot:heading>
        Create New Quiz
    </x-slot:heading>

    <div class="bg-gray-900 text-gray-100 shadow rounded-xl p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Add New Quiz</h2>

        <form method="POST" action="/teacher/quiz/store" class="space-y-6">
            @csrf

            <!-- Quiz Title -->
            <div>
                <label for="title" class="block mb-2 font-semibold">Quiz Title</label>
                <input type="text" id="title" name="title"
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-indigo-500"
                       required>
            </div>

            <!-- Lesson ID (optional dropdown if lessons exist) -->
            <div>
                <label for="lesson_id" class="block mb-2 font-semibold">Lesson</label>
                <select id="lesson_id" name="lesson_id"
                        class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Select Lesson --</option>
                    @foreach($lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
                    Create Quiz
                </button>
            </div>
        </form>
    </div>
</x-layout>
