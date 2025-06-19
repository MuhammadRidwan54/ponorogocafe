@props(['name' => ''])

@php
$icons = [
    'clock' => '<path d="M12 8v4l3 3" />',
    'car' => '<path d="M5 20h14a1 1 0 001-1v-7a1 1 0 00-.293-.707l-7-7a1 1 0 00-1.414 0l-7 7A1 1 0 004 12v7a1 1 0 001 1z"/>',
    'users' => '<path d="M17 20h5v-2a4 4 0 00-5-4"/><path d="M9 20H4v-2a4 4 0 015-4"/><circle cx="9" cy="7" r="4"/><circle cx="17" cy="7" r="4"/>',
    'dollar-sign' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>',
    'map-pin' => '<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>',
];
@endphp

<svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    {!! $icons[$name] ?? '' !!}
</svg>
