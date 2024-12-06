@props(['id' => ''])

<ul {{ $attributes->merge(['id' => $id, 'class' => 'text-sm text-red-600 space-y-1 text-error hidden']) }}>
</ul>
