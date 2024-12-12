@props(['disabled' => false, 'required' => false])

<textarea @disabled($disabled) @required($required)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm']) }}></textarea>
