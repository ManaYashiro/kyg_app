@php

    $inSize = ['text-xs, text-sm', 'text-md', 'text-lg'];
    $sizeClass = 'text-' . $size;
    if (in_array($sizeClass, $inSize)) {
        $size = $sizeClass;
    } else {
        $size = 'text-sm';
    }
@endphp

<span class="font-normal {{ $size }}">{{ $text }}</span>
