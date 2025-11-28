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
    padding: 0.375rem 0.5rem;
    border: none; /* remove underline style */
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.25;
    color: #6b7280;
    border-radius: 0.5rem;
    transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
}

.nav-link:hover {
    color: #1f2937;
    background-color: #f3f4f6; /* gray-100 */
}

.nav-link-active {
    color: #1f2937;
    background-color: #f3f4f6; /* keep bg gray when active */
}

.nav-link:focus {
    outline: none;
    color: #1f2937;
    background-color: #f3f4f6;
}
</style>
