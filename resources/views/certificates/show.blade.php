<x-layout>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-2xl border-4 border-blue-600 p-10 m-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800">Certificate of Completion</h1>
                
                <p class="text-lg text-gray-600 mt-6">This certificate is proudly presented to</p>
                
                <h2 class="text-5xl font-extrabold text-blue-700 my-8">{{ $certificate->user->name }}</h2>
                
                <p class="text-lg text-gray-600">for successfully completing the lesson</p>
                
                <h3 class="text-3xl font-bold text-gray-800 mt-4">{{ $certificate->lesson->title }}</h3>

                <div class="mt-12 flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm">Issued On</p>
                        <p class="text-gray-700 font-semibold">{{ $certificate->issued_at->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Verification ID</p>
                        <p class="text-gray-700 font-mono text-xs">{{ $certificate->certificate_hash }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-6">
            <x-button href="/certificates">Back to My Certificates</x-button>
        </div>
    </div>
</x-layout>