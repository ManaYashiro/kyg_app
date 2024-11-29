@php
    // Define the allowed colors
    $colors = ['red', 'blue', 'green'];

    // Default to 'red' if $color is not in the allowed colors
    $colorClass = in_array($color, $colors) ? "bg-{$color}-700" : 'bg-red-700';
@endphp

@if ($logout === 'logout')
    <form action="{{ $url }}" method="POST">
        @csrf
    @elseif ($type === 'href' && $url)
        <a href="{{ $url }}">
@endif

<button {{ $attributes->merge(['class' => "$colorClass text-white px-4 py-2 rounded-none main-button"]) }}
    type="{{ $type }}" @if ($type === 'submit') type="submit" @endif>
    {{ $name }}
</button>

@if ($logout === 'logout')
    </form>
@elseif ($type === 'href' && $url)
    </a>
@endif
