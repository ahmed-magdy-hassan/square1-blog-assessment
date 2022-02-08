@props(['name', 'label', 'hideLabel' => false, 'src' => null, 'alt' => null, 'maxWidth' => '20', 'overlay' => false])

@php
    $refName = str_replace(['[',']'], ['_',''], $name);
    $errName = str_replace(['[',']'], ['.',''], $name);
@endphp

<div x-data="{imageName: null, imagePreview: null}" class="col-span-6 sm:col-span-4">
    <!-- Profile Photo File Input -->
    <input type="file" class="hidden"
           {{ $attributes }}
           name="{{ $name }}"
           x-ref="{{ $refName }}"
           x-on:change="
                    imageName = $refs.{{ $refName }}.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.{{ $refName }}.files[0]);
            " />

    @if(!$hideLabel)
        <x-jet-label for="{{ $refName }}" value="{{ __($label) }}" />
    @endif

    @if($src)
        <!-- Current Profile {{ $label }} -->
        <div class="mt-2" x-show="! imagePreview">
            @if($overlay)
                <div class="mt-2 relative max-h-48 w-48 divImgOverlayWithText">
            @endif
            <img src="{{ $src }}" alt="{{ $alt }}" class="max-h-{{$maxWidth}} w-{{$maxWidth}} object-cover">
            @if($overlay)
                <div class="divImgOverlay"></div>
                <div class="divImgOverlayText">{{ __('Upload') }}</div>
            </div>
            @endif
        </div>
    @endif

    <!-- New Profile {{ $label }} Preview -->
    <div class="mt-2" x-show="imagePreview">
        <img x-bind:src="imagePreview" alt="" class="max-h-{{$maxWidth}} w-{{$maxWidth}} object-cover">
        <!--<span class="block w-{{$maxWidth}} h-{{$maxWidth}}"
              x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
        </span>-->
    </div>

    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.{{ $refName }}.click()">
        {{ __("Select A New $label") }}
    </x-jet-secondary-button>

    <x-jet-input-error for="{{ $errName }}" class="mt-2" />
</div>
