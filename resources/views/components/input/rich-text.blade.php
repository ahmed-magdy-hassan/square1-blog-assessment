{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}
<div wire:ignore
    class="rounded-lg shadow-sm
    @if($attributes->get('class'))
    {{$attributes->get('class')}}
    @endif
    "
    x-data="{
        @if($attributes->get('wire:model'))
        value: @entangle($attributes->wire('model')),
        @else
        value: '{{ $attributes->get('value') }}',
        @endif
        isFocused() { return document.activeElement !== this.$refs.trix },
        setValue() {
            if(this.$refs.trix.editor){
                this.$refs.trix.editor.loadHTML(this.value)
            }
        },
    }"
    x-init="setValue(); $watch('value', () => isFocused() && setValue())"
    @if($attributes->get('wire:model'))
    x-on:trix-change.debounce.1000ms="value = $event.target.value"
    @else
    x-on:trix-change="value = $event.target.value"
    @endif
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <input
        @if(!$attributes->get('wire:model'))
            value="{{ $attributes->get('value') }}"
        @endif
        name="{{$attributes->get('name')}}"
        id="{{$attributes->get('name','x')}}"
        type="hidden">
    <trix-editor
        x-ref="trix"
        input="{{$attributes->get('name','x')}}"
        class="block bg-white border-gray-300 rounded-md w-full transition duration-150 ease-in-out form-textarea sm:text-sm sm:leading-5"></trix-editor>
</div>

@pushonce('styles:trix')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">
@endpushonce

@pushonce('scripts:trix')
<script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>
@endpushonce

