<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Teacher Dashboard</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Manage My Lessons -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-3">My Lessons</h2>
                    <p class="text-gray-400 mb-4">View the lessons currently assigned to you by the admin.</p>
                    <x-button href="/teacher/lessons">View My Lessons</x-button>
                </div>
                
                <!-- Manage Quizzes -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-3">Manage Quizzes</h2>
                    <p class="text-gray-400 mb-4">Create, edit, and delete quizzes for your assigned lessons.</p>
                    <x-button href="/teacher/quiz">Go to Quizzes</x-button>
                </div>

                <!-- Monitor Students (Future) -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 opacity-50">
                    <h2 class="text-xl font-bold text-white mb-3">Monitor Students</h2>
                    <p class="text-gray-400 mb-4">Review student quiz attempts and writing submissions (Coming Soon).</p>
                    <x-button href="#" :disabled="true">Coming Soon</x-button>
                </div>

                <!-- Live Sessions (Future) -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 opacity-50">
                    <h2 class="text-xl font-bold text-white mb-3">Host Live Session</h2>
                    <p class="text-gray-400 mb-4">Start a live video session with students (Coming Soon).</p>
                    <x-button href="#" :disabled="true">Coming Soon</x-button>
                </div>
            </div>
        </div>
    </main>
</x-layout>