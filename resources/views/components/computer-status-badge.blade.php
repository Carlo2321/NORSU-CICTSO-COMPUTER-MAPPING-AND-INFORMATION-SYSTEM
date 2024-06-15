@props(['status'])

@php
$classes = [
    'working' => 'text-green-500',
    'not_working' => 'text-red-500',
][$status] ?? '';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ ucfirst($status) }}
</span>
