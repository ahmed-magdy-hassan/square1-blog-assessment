{{--
-- Important note:
--
-- This template is based on an example from Tailwind UI, and is used here with permission from Tailwind Labs
-- for educational purposes only. Please do not use this template in your own projects without purchasing a
-- Tailwind UI license, or they’ll have to tighten up the licensing and you’ll ruin the fun for everyone.
--
-- Purchase here: https://tailwindui.com/
--}}

@props([
    'placeholder' => null,
    'trailingAddOn' => null,
])

<div class="flex w-full">
    <select {{ $attributes->merge(['class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}>
    @if ($placeholder)
        <option disabled value="">{{ $placeholder }}</option>
    @endif

    {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
</div>
