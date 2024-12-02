@php

    // write the tailwind class as whole text instead of concatination, e.g. 'text-' . $color . '-500'
    $text = $text;
    $class = $class;
    $inColor = ['text-red-500', 'text-black-500', 'text-blue-500'];
    $colorClass = 'text-' . $color . '-500';
    if (in_array($colorClass, $inColor)) {
        $color = $colorClass;
    } else {
        $color = 'text-black-500';
    }

    $inBorder = ['border-t-2', 'border-b-2', 'border-l-2', 'border-r-2'];
    if ($border !== 'n') {
        $borderClass = 'border-' . $border . '-2';
        if (in_array($borderClass, $inBorder)) {
            $border = $borderClass;
        } else {
            $border = 'border-b-2';
        }
        if ($border == 'l') {
            $borderClass .= ' ps-1';
        }
        if ($border == 'b') {
            $borderClass .= ' pb-1';
        }
        $border = trim($borderClass);
    } else {
        $border = '';
    }
@endphp

<div {{ $attributes->merge(['class' => 'border-red-1000 ' . $class . ' ' . $border . ' ' . $color]) }}>
    <span class="font-bold">{{ $text }}</span>
</div>
