<x-layout>
    <x-slot:heading>
        User Quiz Performance
    </x-slot:heading>
    @guest
        <h2 class="text-2xl font-bold mb-4">Login to watch track your performance</h2>
    @endguest
    <div class="max-w-4xl mx-auto mt-6 bg-gray-900 p-6 rounded-2xl shadow-lg text-white">

        @auth

        <h2 class="text-2xl font-bold mb-4">Quiz Attempts for User #{{ $user_id }}</h2>

        @if($quiz_track->isEmpty())
            <p class="text-gray-400">No quiz attempts found for this user.</p>
        @else
            <table class="w-full border-collapse border border-gray-700">
                <thead>
                <tr class="bg-gray-800">
                    <th class="border border-gray-700 px-4 py-2 text-left">Quiz ID</th>
                    <th class="border border-gray-700 px-4 py-2 text-left">User ID</th>
                    <th class="border border-gray-700 px-4 py-2 text-left">Score</th>
                    <th class="border border-gray-700 px-4 py-2 text-left">Attempted On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quiz_track as $attempt)
                    <tr class="hover:bg-gray-800">
                        <td class="border border-gray-700 px-4 py-2">{{ $attempt->quiz_id }}</td>
                        <td class="border border-gray-700 px-4 py-2">{{ $attempt->user_id }}</td>
                        <td class="border border-gray-700 px-4 py-2">{{ $attempt->score }}</td>
                        <td class="border border-gray-700 px-4 py-2">{{ $attempt->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        @endauth

    </div>
</x-layout>
