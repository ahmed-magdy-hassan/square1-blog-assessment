{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

<x-link
    {{ $attributes->merge([
        'class' => 'text-white bg-yellow-400 hover:bg-yellow-300 active:bg-yellow-500 border-yellow-400'
    ]) }}
>{{ $slot }}</x-link>
