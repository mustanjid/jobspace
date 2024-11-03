@props(['tag', 'size' => 'base'])

@php
    $class = 'bg-black/10 rounded-xl font-bold hover:bg-black/25 transition-colors duration-300';
    if ($size === 'base') {
         $class .= ' px-5 py-1 text-sm';
    }

    if ($size === 'small') {
        $class .= ' px-3 py-1 text-2xs';
    }
@endphp

<a href="/tags/{{ strtolower($tag->name) }}" class="{{ $class }}">
    {{ $tag->name }}
</a>
