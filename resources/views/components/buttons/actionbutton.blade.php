<div class="w-full">
    @if ($logout === 'logout')
        <form action="{{ $url }}" method="POST">
            @csrf
        @elseif ($url)
            <a href="{{ $url }}">
    @endif

    <button {{ $attributes->merge(['class' => 'bg-red-1000 text-white text-xs px-2 py-2 rounded w-full']) }}
        type="{{ $type }}">
        {{ $name }}
    </button>

    @if ($logout === 'logout')
        </form>
    @elseif ($url)
        </a>
    @endif
</div>
