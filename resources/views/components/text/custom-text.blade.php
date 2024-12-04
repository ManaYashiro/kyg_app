@props([
    'text', // The label text to display
    'id' => '',
    'class' => '',
    'textClass' => '',
    'attributes' => [], // Additional button attributes
])

<div {{ $attributes->merge(['id' => $id, 'class' => $class]) }}>
    <span class="{{ $textClass }}">{{ $text }}</span>
</div>
