@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-100 dark:bg-gray-700 flex items-center p-2 text-gray-900 rounded-lg dark:text-white  group'
            : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white  group hover:bg-gray-100 hover:dark:bg-gray-700';
@endphp



<a {{ $attributes->merge(['class' => $classes]) }} >
    {{$slot}}
 </a>
