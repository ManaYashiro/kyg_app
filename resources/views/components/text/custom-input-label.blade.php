@php
    $optionClass = '';
    if ($option == '必須') {
        $optionClass .= ' form-required';
    }
    if ($option == '任意') {
        $optionClass .= ' form-any';
    }
@endphp
<div {{ $attributes->merge(['class' => 'flex gap-1 form-label ' . $class]) }}>
    @if ($option !== '')
        <span class="{{ $optionClass }}">{{ $option }}</span>
    @endif
    <span class="font-bold">{{ $text }}</span>
</div>
