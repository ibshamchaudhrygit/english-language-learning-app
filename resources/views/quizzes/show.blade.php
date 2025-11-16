<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{ $quiz->title }}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-md rounded-lg p-6 lg:p-8 text-gray-300">
                
                <!-- This form submits all answers to the server for grading -->
                <form id="quiz-form" method="POST" action="/quiz/{{ $quiz->id }}/submit">
                    @csrf
                    <div class="space-y-8">
                        @foreach($questions as $index => $question)
                            <div class="question-block" data-question-id="{{ $question->id }}">
                                <h3 class="text-xl font-semibold text-white mb-4">
                                    Question {{ $index + 1 }}: {{ $question->title }}
                                </h3>
                                
                                @switch($question->type)
                                    @case('multiple_choice')
                                        <div class="space-y-3">
                                            <label class="flex items-center p-3 rounded-lg bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="a" class="h-4 w-4 text-indigo-600 border-gray-500 focus:ring-indigo-500">
                                                <span class="ml-3 text-gray-200">{{ $question->option_a }}</span>
                                            </label>
                                            <label class="flex items-center p-3 rounded-lg bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="b" class="h-4 w-4 text-indigo-600 border-gray-500 focus:ring-indigo-500">
                                                <span class="ml-3 text-gray-200">{{ $question->option_b }}</span>
                                            </label>
                                            <label class="flex items-center p-3 rounded-lg bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="c" class="h-4 w-4 text-indigo-600 border-gray-500 focus:ring-indigo-500">
                                                <span class="ml-3 text-gray-200">{{ $question->option_c }}</span>
                                            </label>
                                            <label class="flex items-center p-3 rounded-lg bg-gray-700 hover:bg-gray-600 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="d" class="h-4 w-4 text-indigo-600 border-gray-500 focus:ring-indigo-500">
                                                <span class="ml-3 text-gray-200">{{ $question->option_d }}</span>
                                            </label>
                                        </div>
                                        @break

                                    @case('fill_in_blank')
                                        <p class="text-sm text-gray-400 mb-2">Type your answer in the box below.</p>
                                        <input type="text" name="answers[{{ $question->id }}]" class="mt-1 block w-full lg:w-1/2 rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @break

                                    @case('matching')
                                        @if(is_array($question->options) && isset($question->options['prompts']) && isset($question->options['answers']))
                                            <p class="text-sm text-gray-400 mb-2">Match the prompts on the left with the correct answers on the right.</p>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-3">
                                                    @foreach($question->options['prompts'] as $promptIndex => $prompt)
                                                        <div class="p-3 rounded-lg bg-gray-700 text-gray-200 h-12 flex items-center">{{ $promptIndex + 1 }}. {{ $prompt }}</div>
                                                    @endforeach
                                                </div>
                                                <div class="space-y-3">
                                                    <!-- Simple version: User types the answer corresponding to the number -->
                                                    @foreach($question->options['prompts'] as $promptIndex => $prompt)
                                                         <input type="text" name="answers[{{ $question->id }}][]" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Answer for {{ $promptIndex + 1 }}">
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @break
                                @endswitch
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 border-t border-gray-700 pt-6">
                        <x-form-button type="submit">Submit Quiz</x-form-button>
                    </div>
                </form>

            </div>
        </div>
    </main>


</x-layout>