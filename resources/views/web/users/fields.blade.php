<div>
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value='old("name", $user->name ?? null)' required autofocus autocomplete="name" />
    <x-jet-input-error for="name" class="mt-2" />
</div>

<div class="mt-4">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value='old("email", $user->email ?? null)' required />
    <x-jet-input-error for="email" class="mt-2" />
</div>

<div>
    <x-image-upload name="image" label="Image" :src="$user->profile_photo_url ?? null" :max-width="48" />
    <p class="text-sm text-gray-400 mt-1">{{ __('Maximum file size: 1MB') }}</p>
</div>