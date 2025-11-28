@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'dropdown-content'])

<div class="dropdown-container" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="dropdown-menu dropdown-{{ $align }} dropdown-w-{{ $width }}"
         style="display: none;"
         @click="open = false">
        <div class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>

<style>
.dropdown-container {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    z-index: 50;
    margin-top: 0.5rem;
    border-radius: 0.375rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.dropdown-right {
    right: 0;
    transform-origin: top right;
}

.dropdown-left {
    left: 0;
    transform-origin: top left;
}

.dropdown-top {
    transform-origin: top;
}

.dropdown-w-48 {
    width: 12rem;
}

.dropdown-content {
    padding: 0.25rem 0;
    background-color: white;
    border-radius: 0.375rem;
    border: 1px solid rgba(0, 0, 0, 0.05);
}
</style>
