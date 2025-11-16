<x-layout>
    <x-slot:heading>Watching Now : {{ $lesson->title }}</x-slot:heading>

    <div class="max-w-4xl mx-auto mt-6 bg-gray-900 rounded-2xl shadow-lg overflow-hidden">
        <!-- YouTube Video Preview -->
        <div class="w-full bg-black">
            <iframe
                src="https://www.youtube.com/embed/{{$lesson->video_url}}"
                class="w-full h-72 md:h-96"
                frameborder="0"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Lesson Content -->
        <div class="p-6">
            <h1 class="text-3xl font-bold text-white mb-4">{{ $lesson->title }}</h1>
            <p class="text-gray-300 mb-6">{{ $lesson->description }}</p>

            <div class="flex flex-wrap gap-3 mb-6">
                <span class="bg-blue-700/30 text-blue-300 px-4 py-1 rounded-full text-sm">
                    Price: {{ $lesson->price }}
                </span>
                <span class="bg-green-700/30 text-green-300 px-4 py-1 rounded-full text-sm">
                    Duration: {{ $lesson->duration }}
                </span>
                <span class="bg-yellow-700/30 text-yellow-300 px-4 py-1 rounded-full text-sm">
                    {{ $lesson->enrollments }} Enrolled
                </span>
            </div>

            <a href="/quiz/lessons/{{ $lesson->id }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                 Test your knowledge
            </a>
        </div>
    </div>
</x-layout>
