<x-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-center mb-8">My Certificates</h1>

        @if($certificates->isEmpty())
            <div class="text-center bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-700">You have not earned any certificates yet.</p>
                <x-button href="/lessons" class="mt-4">Start Learning</x-button>
            </div>
        @else
            <div class="space-y-4">
                @foreach($certificates as $certificate)
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-blue-600">{{ $certificate->title }}</h2>
                            <p class="text-gray-600">Issued for completing: <strong>{{ $certificate->lesson->title }}</strong></p>
                            <p class="text-sm text-gray-500">Issued on: {{ $certificate->issued_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <x-button href="/certificates/{{ $certificate->id }}">View Certificate</x-button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>