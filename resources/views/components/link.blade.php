@props(['active' => false, 'responsive' => false])

@php
    if ($responsive) {
        $classes = $active
            ? 'block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white' // Active responsive
            : 'block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white'; // Default responsive
    } else {
        $classes = $active
            ? 'rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white' // Active desktop
            : 'rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white'; // Default desktop
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>