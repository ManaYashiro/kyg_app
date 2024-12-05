@props([
    'divClass' => '', // Class for the container div
    'logout' => null, // Logout trigger
    'url' => null, // The URL link for the button
    'id' => '', // Button id
    'class' => '', // Additional button classes
    'name' => 'Button', // Button label
    'type' => 'button', // Button type
    'attributes' => [], // Additional button attributes
])

@php
    $buttonClass = 'w-full bg-red-1000 text-white rounded w-full' . ($class ? ' ' . $class : '');
@endphp

<div class="{{ $divClass }}">
    @if ($logout === 'logout')
        <form action="{{ $url }}" method="POST">
            @csrf
    @elseif ($url)
        <a href="{{ $url }}">
    @endif

    <button {{ $attributes->merge(['id' => $id, 'class' => $buttonClass]) }} type="{{ $type }}">
        {{ $name }}
    </button>

    @if ($logout === 'logout')
        </form>
    @elseif ($url)
        </a>
    @endif
</div>
