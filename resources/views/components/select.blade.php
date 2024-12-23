<!-- resources/views/components/select.blade.php -->
<select
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm']) }}>
    {{ $slot }}
</select>
