<a {{ $attributes->merge(['class' => 'dropdown-link']) }}>{{ $slot }}</a>

<style>
.dropdown-link {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem;
    text-align: left;
    font-size: 0.875rem;
    line-height: 1.25;
    color: #374151;
    transition: background-color 0.15s ease-in-out;
}

.dropdown-link:hover {
    background-color: #f3f4f6;
}

.dropdown-link:focus {
    outline: none;
    background-color: #f3f4f6;
}
</style>
