@props(['active'])

@php
$classes = ($active ?? false)
            ? 'responsive-nav-link responsive-nav-link-active'
            : 'responsive-nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

<style>
.responsive-nav-link {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem 0.5rem 0.75rem;
    border-left: 4px solid transparent;
    text-align: left;
    font-size: 1rem;
    font-weight: 500;
    color: #6b7280;
    transition: all 0.15s ease-in-out;
}

.responsive-nav-link:hover {
    color: #1f2937;
    background-color: #f9fafb;
    border-left-color: #d1d5db;
}

.responsive-nav-link-active {
    color: #6366f1;
    background-color: #eef2ff;
    border-left-color: #6366f1;
}

.responsive-nav-link:focus {
    outline: none;
    color: #1f2937;
    background-color: #f9fafb;
    border-left-color: #d1d5db;
}
</style>
