<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <form class="mt-4 space-y-4" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        @include('web.posts.fields', [
            'post' => $post ?? null,
        ])

        <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4 btnColorBlueberry">
                {{ __('Create Post') }}
            </x-jet-button>
        </div>
    </form>
</x-app-layout>
