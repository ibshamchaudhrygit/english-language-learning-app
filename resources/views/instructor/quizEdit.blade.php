<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Edit Quiz: {{ $quiz->title }}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-white">
                
                <!-- Add Question Form -->
                <div class="lg:col-span-1" x-data="{ type: 'multiple_choice' }">
                    <h2 class="text-2xl font-bold mb-4">Add New Question</h2>
                    <form method="POST" action="/teacher/quiz/{{ $quiz->id }}/questions" class="bg-gray-800 shadow-md rounded-lg p-6">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-300">Question Type</label>
                            <select id="type" name="type" x-model="type" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="multiple_choice">Multiple Choice</option>
                                <option value="fill_in_blank">Fill in the Blank</option>
                                <option value="matching">Matching</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-300">Question Text</label>
                            <textarea id="title" name="title" rows="3" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="e.g., The cat ___ on the mat. (for fill-in-blank, use ___ for the blank)"></textarea>
                        </div>

                        <!-- Multiple Choice Fields -->
                        <div x-show="type === 'multiple_choice'" class="space-y-4">
                            <div>
                                <label for="option_a" class="block text-sm font-medium text-gray-300">Option A</label>
                                <input type="text" id="option_a" name="option_a" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="option_b" class="block text-sm font-medium text-gray-300">Option B</label>
                                <input type="text" id="option_b" name="option_b" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="option_c" class="block text-sm font-medium text-gray-300">Option C</label>
                                <input type="text" id="option_c" name="option_c" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="option_d" class="block text-sm font-medium text-gray-300">Option D</label>
                                <input type="text" id="option_d" name="option_d" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="correct_answer_mc" class="block text-sm font-medium text-gray-300">Correct Answer</label>
                                <select id="correct_answer_mc" name="correct_answer" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="a">Option A</option>
                                    <option value="b">Option B</option>
                                    <option value="c">Option C</option>
                                    <option value="d">Option D</option>
                                </select>
                            </div>
                        </div>

                        <!-- Fill in the Blank Fields -->
                        <div x-show="type === 'fill_in_blank'">
                            <div>
                                <label for="correct_answer_fb" class="block text-sm font-medium text-gray-300">Correct Answer</label>
                                <input type="text" id="correct_answer_fb" name="correct_answer" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="The exact word(s) for the blank">
                            </div>
                        </div>

                        <!-- Matching Fields -->
                        <div x-show="type === 'matching'" class="space-y-4">
                            <p class="text-sm text-gray-400">Enter matching pairs. The user will match Prompt 1 to Answer 1, etc.</p>
                            <!-- Simple implementation for 3 pairs -->
                            <div class="flex space-x-2">
                                <input type="text" name="options[prompts][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Prompt 1">
                                <input type="text" name="options[answers][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Answer 1">
                            </div>
                            <div class="flex space-x-2">
                                <input type="text" name="options[prompts][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Prompt 2">
                                <input type="text" name="options[answers][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Answer 2">
                            </div>
                            <div class="flex space-x-2">
                                <input type="text" name="options[prompts][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Prompt 3">
                                <input type="text" name="options[answers][]" class="block w-1/2 rounded-md border-gray-600 bg-gray-700 text-white" placeholder="Answer 3">
                            </div>
                            <!-- 'correct_answer' is not needed for matching, as the order is the answer -->
                        </div>

                        <div class="mt-6">
                            <x-form-button>Add Question</x-form-button>
                        </div>
                    </form>
                </div>

                <!-- Existing Questions List -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold mb-4">Existing Questions</h2>
                    <div class="space-y-4">
                        @forelse($questions as $question)
                            <div class="bg-gray-800 shadow-md rounded-lg p-4">
                                <!-- TODO: This view only shows multiple choice. Needs update to show other types. -->
                                <p class="font-semibold text-gray-200">{{ $loop->iteration }}. {{ $question->title }}</p>
                                <span class="text-xs font-medium rounded-full px-2 py-0.5 bg-indigo-600 text-indigo-100">{{ str_replace('_', ' ', $question->type) }}</span>
                                
                                <div class="mt-2 text-sm text-gray-400">
                                    @if($question->type == 'multiple_choice')
                                        <ul class="list-disc list-inside">
                                            <li>A: {{ $question->option_a }}</li>
                                            <li>B: {{ $question->option_b }}</li>
                                            <li>C: {{ $question->option_c }}</li>
                                            <li>D: {{ $question->option_d }}</li>
                                        </ul>
                                        <p class="mt-1 text-green-400">Correct: {{ strtoupper($question->correct_answer) }}</p>
                                    @elseif($question->type == 'fill_in_blank')
                                        <p class="mt-1 text-green-400">Correct: {{ $question->correct_answer }}</p>
                                    @elseif($question->type == 'matching' && is_array($question->options))
                                        <ul class="list-disc list-inside">
                                            @foreach($question->options['prompts'] as $index => $prompt)
                                                <li>{{ $prompt }} -> {{ $question->options['answers'][$index] ?? 'N/A' }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2 mt-3">
                                    <!-- Edit button (future feature) -->
                                    <!-- <x-button href="#" class="bg-yellow-600 hover:bg-yellow-700 text-xs">Edit</x-button> -->
                                    <form method="POST" action="/teacher/questions/{{ $question->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-form-button class="bg-red-600 hover:bg-red-700 text-xs">Delete</x-Gform-button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400">No questions added to this quiz yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>