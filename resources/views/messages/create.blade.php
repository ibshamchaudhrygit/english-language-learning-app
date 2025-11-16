<x-layout>
    <x-slot:heading>Create Message</x-slot:heading>

    <form method="POST" action="">
        @csrf
        <x-form-field>
            <x-form-label for="title">Title</x-form-label>
            <div class="mt-2">
                <x-form-input type="text" name="title" placeholder="Enter a title"/>
                <x-form-textarea name="body" placeholder="Type your message body" class="text-gray-900 outline-none mt-5 h-[100px]"></x-form-textarea>
            </div>
            <x-form-button type="submit">Submit</x-form-button>
        </x-form-field>
    </form>

</x-layout>
