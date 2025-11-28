@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link nav-link-active'
            : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

<style>
.nav-link {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.25rem;
    border-bottom: 2px solid transparent;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25;
    color: #6b7280;
    transition: all 0.15s ease-in-out;
}

.nav-link:hover {
    color: #374151;
    border-bottom-color: #d1d5db;
}

.nav-link-active {
    color: #1f2937;
    border-bottom-color: #6366f1;
}

.nav-link:focus {
    outline: none;
    color: #374151;
    border-bottom-color: #6366f1;
}
</style>
