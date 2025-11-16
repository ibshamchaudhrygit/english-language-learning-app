{{-- UPDATED: Changed all classes for dark mode --}}
<div class="flex items-center rounded-md bg-gray-700 pl-3 outline-1 -outline-offset-1 outline-gray-600 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
    <input  {{ $attributes->merge([
        'class' => 'block min-w-0 grow bg-gray-700 py-1.5 pr-3 px-2 text-white placeholder:text-gray-400 focus:outline-none sm:text-sm/6'
    ]) }}  />
</div>