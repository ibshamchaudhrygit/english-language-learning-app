<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{ $lesson->title }}</h1>
            <p class="text-indigo-300">{{ $lesson->category }} | {{ ucfirst($lesson->skill_level) }}</p>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 bg-gray-800 rounded-lg shadow-md p-6">
                    <!-- Video Player -->
                    @if($lesson->video_url)
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        <iframe src="{{ $lesson->video_url }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="w-full h-full rounded-lg">
                        </iframe>
                    </div>
                    @endif

                    <!-- Audio Player -->
                    @if($lesson->audio_url)
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-white mb-2">Listen</h3>
                        <audio controls class="w-full">
                            <source src="{{ $lesson->audio_url }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    @endif
                    
                    <!-- Description -->
                    <h2 class="text-2xl font-bold text-white mb-4">Lesson Details</h2>
                    <div class="prose prose-invert max-w-none text-gray-300">
                        {{ $lesson->description }}
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="mt-6 lg:mt-0 lg:col-span-1">
                    <div class="bg-gray-800 rounded-lg shadow-md p-6 space-y-4">
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-chalkboard-teacher fa-lg w-8 text-indigo-400"></i>
                            <span class="ml-3">Taught by <span class="font-bold text-white">{{ $lesson->user->name }}</span></span>
                        </div>
                        <div class="flex items-center text-gray-300">
                            <i class="far fa-clock fa-lg w-8 text-indigo-400"></i>
                            <span class="ml-3">Duration: <span class="font-bold text-white">{{ $lesson->duration ?? 'N/A' }}</span></span>
                        </div>
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-users fa-lg w-8 text-indigo-400"></i>
                            <span class="ml-3"><span class="font-bold text-white">{{ $lesson->enrollments ?? 0 }}</span> students enrolled</span>
                        </div>
                        
                        <!-- Quiz Button -->
                        @if($lesson->quiz)
                        <div class="border-t border-gray-700 pt-4">
                            <x-button href="/quiz/lessons/{{ $lesson->id }}" class="w-full text-center">
                                Take the Quiz
                                <i class="fas fa-arrow-right ml-2"></i>
                            </x-button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>