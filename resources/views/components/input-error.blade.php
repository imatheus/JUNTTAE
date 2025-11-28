@props(['messages'])

@if ($messages)
    <ul class="error-list">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
