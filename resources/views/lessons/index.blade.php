<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">All Lessons</h1>

        <!-- TODO: Add Filtering UI here based on skill_level and category -->
        <!-- 
        <div class="mb-6 flex space-x-4">
            <select class="border rounded-lg p-2">
                <option value="">All Skills</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <select class="border rounded-lg p-2">
                <option value="">All Categories</option>
                <option value="grammar">Grammar</option>
                <option value="vocabulary">Vocabulary</option>
                <option value="speaking">Speaking</option>
            </select>
        </div>
        -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lessons as $lesson)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                    <img src="{{ $lesson->image ?? 'https://placehold.co/600x400/E2E8F0/AAAAAA?text=Lesson' }}" alt="{{ $lesson->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">{{ $lesson->category ?? 'General' }}</span>
                            <span class="text-sm font-semibold 
                                @switch($lesson->skill_level)
                                    @case('beginner') bg-green-100 text-green-700 @break
                                    @case('intermediate') bg-yellow-100 text-yellow-700 @break
                                    @case('advanced') bg-red-100 text-red-700 @break
                                @endswitch
                                px-3 py-1 rounded-full">{{ ucfirst($lesson->skill_level) }}</span>
                        </div>
                        
                        <h2 class="text-xl font-bold mb-2">{{ $lesson->title }}</h2>
                        <p class="text-gray-700 mb-4 h-20">{{ Str::limit($lesson->description, 100) }}</p>
                        <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                            <span><i class="far fa-clock mr-1"></i> {{ $lesson->duration ?? 'N/A' }}</span>
                            <span><i class="fas fa-users mr-1"></i> {{ $lesson->enrollments ?? 0 }} Students</span>
                        </div>
                        <x-button href="/lessons/{{ $lesson->id }}">Start Lesson</x-button>
                    </div>
                </div>
            @empty
                <p class="text-gray-700 col-span-3 text-center">No lessons are available at this time.</p>
            @endforelse
        </div>
    </div>
</x-layout>