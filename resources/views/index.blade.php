<x-layout>
    <!-- Hero Section -->
    <div class="relative bg-gray-900">
        <div class="absolute inset-0">
            <!-- You can add a subtle background image here if you want -->
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 opacity-80"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Learn English Your Way
            </h1>
            <p class="mt-6 max-w-3xl text-xl text-gray-300">
                Join EngageLearn, the gamified, self-paced web app designed to take you from beginner to advanced with interactive lessons, quizzes, and live practice.
            </p>
            <div class="mt-10">
                <x-button href="/register" class="text-base font-medium">
                    Get Started Now
                </x-button>
            </div>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="bg-gray-800 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-400">Learn Faster</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Everything you need to succeed
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    Our platform integrates everything from gamification to live tutors to keep you motivated and on track.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                            <i class="fas fa-puzzle-piece fa-lg text-indigo-400"></i>
                            Interactive Quizzes
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                            <p class="flex-auto">Test your knowledge with quizzes that go beyond multiple-choice, including fill-in-the-blank and matching exercises.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                            <i class="fas fa-trophy fa-lg text-indigo-400"></i>
                            Gamification
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                            <p class="flex-auto">Earn points, unlock badges, and climb the leaderboard. Learning English has never been this fun.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                            <i class="fas fa-comments fa-lg text-indigo-400"></i>
                            Community & Tutors
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-300">
                            <p class="flex-auto">Practice with peers in the forum, chat directly with language partners, or book a live session with a professional tutor.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-layout>