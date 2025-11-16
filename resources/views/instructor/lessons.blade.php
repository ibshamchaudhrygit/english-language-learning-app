<x-layout>
    <x-slot:heading>My Lessons</x-slot:heading>
    <ul>
    @foreach($lessons as $lesson)
        <li>{{$lesson->title}}</li>
    @endforeach
    </ul>
</x-layout>

