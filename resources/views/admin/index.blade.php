<x-layout>
    <x-slot:heading>Admin Dashboard</x-slot:heading>
    <ul>
        <li class="text-blue-800 hover:underline">
            <a href="/admin/content">Manage Content</a>
        </li>
        <li class="text-blue-800 hover:underline">
            <a href="/messages">See Messages</a>
        </li>
        <li class="text-blue-800 hover:underline">
            <a href="/messages/create">Create Message</a>
        </li>
    </ul>


    <form>
        <x-form-field>
            <div class="w-96">
            <x-form-label for="input">Form Input</x-form-label>
            <x-form-input id="input" placeholder="Form Input"></x-form-input>
            </div>
        </x-form-field>
    </form>
</x-layout>
