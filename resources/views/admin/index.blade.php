<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Admin Dashboard</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Manage Lessons -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-3">Manage Lessons</h2>
                    <p class="text-gray-400 mb-4">Create, edit, and delete learning lessons and their content.</p>
                    <x-button href="/admin/content">Go to Lessons</x-button>
                </div>
                
                <!-- Manage Writing Prompts -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-3">Manage Writing Prompts</h2>
                    <p class="text-gray-400 mb-4">Add or edit essay prompts for student writing practice.</p>
                    <x-button href="/admin/prompts">Go to Prompts</x-button>
                </div>

                <!-- Manage Speaking Phrases -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-white mb-3">Manage Speaking Phrases</h2>
                    <p class="text-gray-400 mb-4">Add or edit phrases for student pronunciation practice.</p>
                    <x-button href="/admin/phrases">Go to Phrases</x-button>
                </div>

                <!-- Manage Users (Future) -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 opacity-50">
                    <h2 class="text-xl font-bold text-white mb-3">Manage Users</h2>
                    <p class="text-gray-400 mb-4">View student progress, manage roles, and see analytics (Coming Soon).</p>
                    <x-button href="#" :disabled="true">Coming Soon</x-button>
                </div>
            </div>
        </div>
    </main>
</x-layout>