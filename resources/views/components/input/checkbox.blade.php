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
    'for' => false,
    'label' => false,
    'inline' => false
])
@if($inline)
    <div class="inline-flex rounded-md">
        @if ($label !== false)
            <label for="{{$for}}" class="inline-flex items-center">
                <input {{ $attributes }}
                       type="checkbox"
                       class="
                          rounded
                          border-gray-300
                          text-indigo-600
                          shadow-sm
                          focus:border-indigo-300
                          focus:ring
                          focus:ring-offset-0
                          focus:ring-indigo-200
                          focus:ring-opacity-50
                        ">
                <span class="ml-2">{{$label}}</span>
            </label>
        @else
            <input {{ $attributes }}
                   type="checkbox"
                   class="
                          rounded
                          border-gray-300
                          text-indigo-600
                          shadow-sm
                          focus:border-indigo-300
                          focus:ring
                          focus:ring-offset-0
                          focus:ring-indigo-200
                          focus:ring-opacity-50
                        "
            />
        @endif
    </div>
@else
    <div class="flex rounded-md">
        @if ($label !== false)
            <label for="{{$for}}" class="inline-flex items-center">
                <input {{ $attributes }}
                       type="checkbox"
                       class="
                          rounded
                          border-gray-300
                          text-indigo-600
                          shadow-sm
                          focus:border-indigo-300
                          focus:ring
                          focus:ring-offset-0
                          focus:ring-indigo-200
                          focus:ring-opacity-50
                        ">
                <span class="ml-2">{{$label}}</span>
            </label>
        @else
            <input {{ $attributes }}
                   type="checkbox"
                   class="
                          rounded
                          border-gray-300
                          text-indigo-600
                          shadow-sm
                          focus:border-indigo-300
                          focus:ring
                          focus:ring-offset-0
                          focus:ring-indigo-200
                          focus:ring-opacity-50
                        "
            />
        @endif
    </div>
@endif