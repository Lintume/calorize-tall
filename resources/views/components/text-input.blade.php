@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-stone-200 focus:border-amber-500 focus:ring-amber-500 rounded-xl shadow-sm bg-white/80']) }}
>
