<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Furigana -->
        <div class="mt-4">
            <x-input-label for="furigana" :value="__('Furigana')" />
            <x-text-input id="furigana" class="block mt-1 w-full" type="text" name="furigana" :value="old('furigana')"
                required />
            <x-input-error :messages="$errors->get('furigana')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Post Code -->
        <div class="mt-4">
            <x-input-label for="post_code" :value="__('Post Code')" />
            <x-text-input id="post_code" class="block mt-1 w-full" type="text" name="post_code" :value="old('post_code')"
                required />
            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Building -->
        <div class="mt-4">
            <x-input-label for="building" :value="__('Building')" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building" :value="old('building')"
                required />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        <!-- Preferred Time -->
        <div class="mt-4">
            <x-input-label for="preferred_contact_time" :value="__('Preferred Contact Time')" />
            <x-text-input id="preferred_contact_time" class="block mt-1 w-full" type="time"
                name="preferred_contact_time" :value="old('preferred_contact_time')" required />
            <x-input-error :messages="$errors->get('preferred_contact_time')" class="mt-2" />
        </div>

        <!-- How did you hear -->
        <div class="mt-4">
            <x-input-label for="anket-main" :value="__('How did you hear')" />
            <x-input-label for="anket-main" :value="__('How did you hear about us?')" />
            @foreach ($how_did_you_hear as $anket)
                <div class="flex items-center gap-3 mb-3">
                    <x-text-input id="anket-{{ $anket->id }}" type="checkbox" name="how_did_you_hear[]"
                        :value="$anket->id" :checked="in_array($anket->id, old('how_did_you_hear', []))" />
                    <x-input-label for="anket-{{ $anket->id }}" :value="$anket->name" />
                </div>
            @endforeach
        </div>

        <!-- Newsletter Subscription -->
        <div class="mt-8 flex flex-row gap-3 items-center">
            <x-text-input id="is_newsletter_subscription" type="checkbox" name="is_newsletter_subscription"
                :value="1" :checked="old('is_newsletter_subscription') ? true : false" />
            <x-input-label for="is_newsletter_subscription" :value="__('Newsletter Subscription')" />
            <x-input-error :messages="$errors->get('is_newsletter_subscription')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
