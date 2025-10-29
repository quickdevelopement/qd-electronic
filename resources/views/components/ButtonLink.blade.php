@props(['classe'])

@php
$classes = 'text-sm dark:border-indigo-600 font-medium text-gray-900 dark:text-gray-100  transition duration-150 ease-in-out'.($classe ?? '');        
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} >
    {{ $slot }}
</a>
