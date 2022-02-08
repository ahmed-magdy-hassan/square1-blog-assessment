{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

@props(['label' => ''])

<div x-data="{ open: false }" @keydown.window.escape="open = false" x-on:click.away="open = false" {{ $attributes->merge(['class' => 'relative inline-block text-left']) }}>
    <div>
        <span class="rounded-md shadow-sm ">
            <button x-on:click="open = !open" type="button" class="flex space-x-1 justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" id="options-menu" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                <span>{{ $label }}</span>
            </button>
        </span>
    </div>

    <div x-show="open" style="display: none;" x-description="Dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 w-56 mt-2 origin-top-right rounded-md shadow-lg">
        <div class="bg-white rounded-md shadow-xs">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
