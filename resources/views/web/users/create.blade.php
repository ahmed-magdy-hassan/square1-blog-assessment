<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <form class="mt-4 space-y-4" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf

        @include('web.users.fields', [
            'users' => $users ?? null,
        ])
        @include('web.users.password-field')

        <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4 btnColorBlueberry">
                {{ __('Create User') }}
            </x-jet-button>
        </div>
    </form>

</x-app-layout>
