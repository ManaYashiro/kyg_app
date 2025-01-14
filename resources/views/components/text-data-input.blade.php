@props(['disabled' => false, 'required' => false])

<input @disabled($disabled) @required($required)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm']) }}>
