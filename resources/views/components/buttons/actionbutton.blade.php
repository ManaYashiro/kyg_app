@php
    $buttonClass = 'bg-red-1000 text-white rounded w-full' . ($class ? ' ' . $class : '');
@endphp

<div class="w-full">
    @if ($logout === 'logout')
        <form action="{{ $url }}" method="POST">
            @csrf
        @elseif ($url)
            <a href="{{ $url }}">
    @endif

    <button {{ $attributes->merge(['class' => $buttonClass]) }} type="{{ $type }}">
        {{ $name }}
    </button>

    @if ($logout === 'logout')
        </form>
    @elseif ($url)
        </a>
    @endif
</div>
