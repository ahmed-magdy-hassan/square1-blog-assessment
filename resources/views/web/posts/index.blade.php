<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>
            <x-link.primary href="{{ route('posts.create') }}" class="bg-green-600 hover:bg-green-500 active:bg-green-700 border-green-600">
                <x-icon.plus/> {{ __('New') }}
            </x-link.primary>
        </div>
    </x-slot>

    <div class="py-4">
        <div>
            <header class="pt-4 pb-4 sm:pb-16 sm:text-center">
                <h1 class="mb-4 text-3xl sm:text-4xl tracking-tight text-slate-900 font-extrabold dark:text-slate-700">My Posts</h1>
            </header>
            <livewire:web.posts.index />
        </div>
    </div>
</x-app-layout>
