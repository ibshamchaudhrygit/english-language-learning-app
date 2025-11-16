<x-layout>
    <x-slot:heading>Lessons</x-slot:heading>
    @auth
    <p class="text-gray-300 mb-6">{{!empty($lessons) ? "Select a lesson to start" : "No lesson available"}}</p>
    @endauth

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @guest
            <p>Please Login to watch the Lessons.</p>
        @endguest
    @auth
        @foreach($lessons as $lesson)
            <a href="/lessons/{{ $lesson->id }}"
               class="group relative bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-2 hover:scale-[1.03] hover:shadow-2xl">

                <!-- Glow effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-0 group-hover:opacity-20 blur-2xl transition duration-300"></div>

                <div class="p-6 relative z-10">
                    <h2 class="text-xl font-semibold text-white mb-3 group-hover:text-blue-300 transition">
                        {{ $lesson->title }}
                    </h2>
                    <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $lesson->description }}</p>

                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="bg-blue-700/30 text-blue-300 px-3 py-1 rounded-full">
                            {{ $lesson->price }}
                        </span>
                        <span class="bg-green-700/30 text-green-300 px-3 py-1 rounded-full">
                            {{ $lesson->duration }}
                        </span>
                        <span class="bg-yellow-700/30 text-yellow-300 px-3 py-1 rounded-full">
                            {{ $lesson->enrollments }} Enrolled
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
        @endauth
    </div>
</x-layout>
