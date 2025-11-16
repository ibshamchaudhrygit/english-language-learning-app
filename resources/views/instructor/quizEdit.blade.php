<x-layout>
    <x-slot:heading>
        ✏️ Edit Quiz: {{ $quiz->title }}
    </x-slot:heading>

    <div class="bg-gray-900 min-h-screen text-gray-100 p-6">
        <div class="max-w-4xl mx-auto">

            {{-- Quiz Info --}}
            <div class="mb-6 flex item-center justify-between">
              <div>
                  <h1 class="text-2xl font-bold">Quiz: {{ $quiz->title }}</h1>
                  <p class="text-gray-400">Manage questions below</p>
              </div>
                <div>
                <a href="/teacher/quiz" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white" >Go Back</a>
                </div>
            </div>

            {{-- Add Question --}}
            <div class="bg-gray-800 rounded-xl shadow p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">➕ Add New Question</h2>
                <form method="POST" action="/teacher/quiz/{{ $quiz->id }}/questions" class="space-y-3">
                    @csrf
                    <input type="text" name="title" placeholder="Question Title"
                           class="w-full p-2 rounded bg-gray-700 text-gray-100">

                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="option_a" placeholder="Option A"
                               class="p-2 rounded bg-gray-700 text-gray-100">
                        <input type="text" name="option_b" placeholder="Option B"
                               class="p-2 rounded bg-gray-700 text-gray-100">
                        <input type="text" name="option_c" placeholder="Option C"
                               class="p-2 rounded bg-gray-700 text-gray-100">
                        <input type="text" name="option_d" placeholder="Option D"
                               class="p-2 rounded bg-gray-700 text-gray-100">
                    </div>

                    <select name="correct_answer" class="w-full p-2 rounded bg-gray-700 text-gray-100">
                        <option value="">-- Correct Answer --</option>
                        <option value="option_a">Option A</option>
                        <option value="option_b">Option B</option>
                        <option value="option_c">Option C</option>
                        <option value="option_d">Option D</option>
                    </select>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white">
                        Add Question
                    </button>
                </form>
            </div>

            {{-- Existing Questions --}}
            <h2 class="text-xl font-semibold mb-4">📋 Existing Questions</h2>
            <div class="space-y-6">
                @foreach($questions as $q)
                    <div class="bg-gray-800 rounded-xl shadow p-5">
                        <form method="POST" action="/teacher/questions/{{ $q->id }}/update" class="space-y-3">
                            @csrf
                            <input type="text" name="title" value="{{ $q->title }}"
                                   class="w-full p-2 rounded bg-gray-700 text-gray-100">

                            <div class="grid grid-cols-2 gap-3">
                                <input type="text" name="option_a" value="{{ $q->option_a }}"
                                       class="p-2 rounded bg-gray-700 text-gray-100">
                                <input type="text" name="option_b" value="{{ $q->option_b }}"
                                       class="p-2 rounded bg-gray-700 text-gray-100">
                                <input type="text" name="option_c" value="{{ $q->option_c }}"
                                       class="p-2 rounded bg-gray-700 text-gray-100">
                                <input type="text" name="option_d" value="{{ $q->option_d }}"
                                       class="p-2 rounded bg-gray-700 text-gray-100">
                            </div>

                            <select name="correct_answer" class="w-full p-2 rounded bg-gray-700 text-gray-100">
                                <option value="option_a" @if($q->correct_answer=='option_a') selected @endif>Option A</option>
                                <option value="option_b" @if($q->correct_answer=='option_b') selected @endif>Option B</option>
                                <option value="option_c" @if($q->correct_answer=='option_c') selected @endif>Option C</option>
                                <option value="option_d" @if($q->correct_answer=='option_d') selected @endif>Option D</option>
                            </select>

                            <div class="flex justify-between">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
                                    💾 Update
                                </button>
                        </form>

                        <form method="POST" action="/teacher/questions/{{ $q->id }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>

</x-layout>
