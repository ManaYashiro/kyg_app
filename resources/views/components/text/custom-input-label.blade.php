@props([
    'text', // The label text to display
    'option' => '', // The optional text (e.g., '必須' or '任意')
    'spanClass' => 'font-bold flex-1', // Default class for the text span (optional, defaults to 'font-bold')
    'class' => '', // Additional classes for the root div (optional)
    'attributes' => [], // Additional button attributes
])

@php
    $optionClass = '';
    if ($option == '必須') {
        $optionClass .= ' form-required';
    }
    if ($option == '任意') {
        $optionClass .= ' form-any';
    }
@endphp
<div {{ $attributes->merge(['class' => 'flex items-start justify-start gap-1 form-label ' . $class]) }}>
    @if ($option !== '')
        <span class="{{ $optionClass }}">{{ $option }}</span>
    @endif
    <span class="{{ $spanClass }}">{{ $text }}</span>
</div>
