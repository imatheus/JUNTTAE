@props(['status'])

@if ($status)
    <div style="font-weight: 500; font-size: 0.875rem; color: #059669;">
        {{ $status }}
    </div>
@endif
