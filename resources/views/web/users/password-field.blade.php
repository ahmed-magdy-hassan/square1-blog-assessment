<div class="mt-4">
    <x-jet-label for="password" value="{{ __('Password') }}" />
    <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" autocomplete="new-password" />
    <x-jet-input-error for="password" class="mt-2" />
    <p class="text-sm text-gray-400 mt-1">* {{__('Password should be at least 8 characters') }}</p>
</div>

<div class="mt-4">
    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
    <x-jet-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" autocomplete="new-password" />
</div>