<x-guest-layout>
    <div class="max-w-full {{ $success === 'true' ? 'bg-success-response' : 'bg-error-response' }}">
        @foreach ($messages as $message)
            <span>{{ $message }}</span>
        @endforeach
    </div>

    <div class="max-w-lg mt-6 py-8 mx-auto">
        <div class="flex flex-col items-end justify-center gap-10 mt-4">
            <x-buttons.actionbutton name="{{ __($actionText) }}" type="button" url="{{ $actionUrl }}" class="px-4 py-4"
                divClass="w-full mx-auto" />
        </div>
    </div>
</x-guest-layout>
