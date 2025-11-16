<x-layout>
    <x-slot:heading>All Messages</x-slot:heading>
    <ul>
        @foreach($messages as $message)
            <li>
            <a class="text-blue-800 hover:text-blue-600" href="/messages/{{$message["id"]}}">
                {{$message["title"]}}
            </a>
            </li>
        @endforeach
    </ul>
</x-layout>
