<x-layout>
    <x-slot:heading>
        Quiz for {{ $quiz->title }}
    </x-slot:heading>

    <div class="max-w-2xl mx-auto mt-6 bg-gray-900 p-6 rounded-2xl shadow-lg text-white">
        <h2 class="text-2xl font-bold mb-4">Test Your Knowledge</h2>

        <!-- Quiz Form -->
        <form id="quizForm" method="POST" action="/quiz/submit/{{$quiz->id}}/{{Auth::user()->id}}">
            @csrf
            @foreach($questions as $index => $question)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">
                        {{ $index+1 }}. {{ $question->title }}
                    </h3>
                    <div class="space-y-2 mt-2">
                        <label class="block">
                            <input type="radio" name="q{{ $question->id }}" value="option_a" class="mr-2">
                            {{ $question->option_a }}
                        </label>
                        <label class="block">
                            <input type="radio" name="q{{ $question->id }}" value="option_b" class="mr-2">
                            {{ $question->option_b }}
                        </label>
                        <label class="block">
                            <input type="radio" name="q{{ $question->id }}" value="option_c" class="mr-2">
                            {{ $question->option_c }}
                        </label>
                        <label class="block">
                            <input type="radio" name="q{{ $question->id }}" value="option_d" class="mr-2">
                            {{ $question->option_d }}
                        </label>
                    </div>
                </div>
            @endforeach

            <!-- Hidden input for score -->
            <input type="hidden" name="score" id="scoreInput">

            <button type="submit"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white">
                Submit Quiz
            </button>
        </form>

        <div id="resultBox" class="hidden mt-6 p-4 rounded-xl text-center text-xl font-bold"></div>
    </div>

    <script>
        const correctAnswers = {
            @foreach($questions as $q)
            "q{{ $q->id }}": "{{ trim($q->correct_answer) }}",
            @endforeach
        };

        const quizForm = document.getElementById("quizForm");
        quizForm.addEventListener("submit", function(e) {
            e.preventDefault(); // stop immediate submission

            let score = 0;
            let total = Object.keys(correctAnswers).length;

            for (let qid in correctAnswers) {
                let selected = document.querySelector(`input[name="${qid}"]:checked`);
                if (selected && selected.value.trim() === correctAnswers[qid]) {
                    score++;
                }
            }

            // Put score into hidden input
            document.getElementById("scoreInput").value = score;

            let resultBox = document.getElementById('resultBox');
            resultBox.classList.remove('hidden');
            resultBox.textContent = `🎉 You scored ${score} out of ${total}!`;

            // Reset styling
            resultBox.className = "mt-6 p-4 rounded-xl text-center text-xl font-bold";

            // Apply score color
            if (score === total) {
                resultBox.classList.add("bg-green-600");
            } else if (score >= total/2) {
                resultBox.classList.add("bg-yellow-600");
            } else {
                resultBox.classList.add("bg-red-600");
            }
            setTimeout(() => {
                quizForm.submit();
            }, 1000);
        });
    </script>
</x-layout>
