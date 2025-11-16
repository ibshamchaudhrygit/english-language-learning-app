<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">My Performance</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-700 bg-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Quiz Title
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 bg-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Score
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-700 bg-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                Attempted On
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">
                        @forelse ($quiz_track as $attempt)
                            <tr class="hover:bg-gray-700">
                                <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                    <p class="whitespace-no-wrap">{{ $attempt->quiz->title }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                    <p class="whitespace-no-wrap font-bold {{ $attempt->score >= 80 ? 'text-green-400' : 'text-yellow-400' }}">
                                        {{ $attempt->score }}%
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                    <p class="whitespace-no-wrap">{{ $attempt->created_at->format('M d, Y h:i A') }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-400">You have not attempted any quizzes yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-layout>