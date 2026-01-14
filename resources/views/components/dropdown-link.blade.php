@props(['active' => false])

@php
    // Note: avoid horizontal margins here — they make the hover background look like it "shifts" horizontally.
    $baseClasses = 'block w-full px-4 py-2 text-start text-sm leading-5 rounded-lg transition duration-150 ease-in-out focus:outline-none';

    $classes = ($active ?? false)
        ? $baseClasses . ' bg-amber-50 text-amber-800 font-semibold'
        : $baseClasses . ' text-stone-700 hover:bg-amber-50 hover:text-amber-700 focus:bg-amber-50';
@endphp

<a
    {{ $attributes->merge(['class' => $classes]) }}
    @if($active) aria-current="page" @endif
>
    {{ $slot }}
</a>
