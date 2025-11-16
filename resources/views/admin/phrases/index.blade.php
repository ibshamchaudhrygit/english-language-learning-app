<x-layout>
    <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">Manage Speaking Phrases</h1>
                <x-button href="/admin/phrases/create">Create New Phrase</x-button>
            </div>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 bg-gray-700 border-b border-gray-600 text-gray-200 text-left text-sm uppercase font-normal">Phrase</th>
                            <th class="px-5 py-3 bg-gray-700 border-b border-gray-600 text-gray-200 text-left text-sm uppercase font-normal">Category</th>
                            <th class="px-5 py-3 bg-gray-700 border-b border-gray-600 text-gray-200 text-left text-sm uppercase font-normal">Skill Level</th>
                            <th class="px-5 py-3 bg-gray-700 border-b border-gray-600 text-gray-200 text-left text-sm uppercase font-normal">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($phrases as $phrase)
                        <tr class="bg-gray-800">
                            <td class="px-5 py-5 border-b border-gray-700 text-sm"><p class="text-gray-200 whitespace-no-wrap">{{ $phrase->phrase }}</p></td>
                            <td class="px-5 py-5 border-b border-gray-700 text-sm"><p class="text-gray-200 whitespace-no-wrap">{{ $phrase->category }}</p></td>
                            <td class="px-5 py-5 border-b border-gray-700 text-sm"><p class="text-gray-200 whitespace-no-wrap">{{ ucfirst($phrase->skill_level) }}</p></td>
                            <td class="px-5 py-5 border-b border-gray-700 text-sm">
                                <div class="flex space-x-2">
                                    <a href="/admin/phrases/{{ $phrase->id }}/edit" class="text-indigo-400 hover:text-indigo-300">Edit</a>
                                    <form method="POST" action="/admin/phrases/{{ $phrase->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-400" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-layout>