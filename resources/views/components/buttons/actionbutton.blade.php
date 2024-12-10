@props([
    'divClass' => '', // Class for the container div
    'url' => null, // The URL link for the button
    'id' => '', // Button id
    'class' => '', // Additional button classes
    'name' => 'Button', // Button label
    'type' => 'button', // Button type
    'isButtonRed' => true, // ButtonClassColor
    'attributes' => [], // Additional button attributes
])

@php
    $buttonColor = $isButtonRed ? 'bg-red-1000 text-white' : 'bg-gray-200 text-black';
    $buttonClass = 'w-full ' . $buttonColor . ' rounded w-full' . ($class ? ' ' . $class : '');
@endphp

<div class="{{ $divClass }}">
    @if ($id === 'logout')
        <form action="{{ $url }}" method="POST">
            @csrf
    @elseif ($url)
        <a href="{{ $url }}">
    @endif

    <button {{ $attributes->merge(['id' => $id, 'class' => $buttonClass]) }} type="{{ $type }}">
        {{ $name }}
    </button>

    @if ($id === 'logout')
        </form>
    @elseif ($url)
        </a>
    @endif
</div>
