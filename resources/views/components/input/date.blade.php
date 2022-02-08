<div
    @if($attributes->get('wire:model'))
    x-data="{ value: @entangle($attributes->wire('model')), picker: undefined }"
    @else
    x-data="{ value: '{{ $attributes->get('value') }}', picker: undefined }"
    @endif
    x-init="
        new Pikaday({
            field: $refs.input,
            format: 'dd-mm-YYYY',
            showTime: false,
            onOpen() { this.setDate($refs.input.value) },
            toString(date, format) {
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();
    
                return `${year}-${month}-${day}`;
            },
            parse(dateTimeString, format) {
                // dateTimeString is the result of `toString` method
                const date = parts[0].split('-');
    
                const day = parseInt(date[0], 10);
                const month = parseInt(date[1], 10) - 1;
                const year = parseInt(date[2], 10);
                return new Date(year, month, day);
            }
        })"
    x-on:change="value = $event.target.value"
    class="mt-1 flex rounded-md shadow-sm"
>
    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </span>

    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
        type="text"
        autocomplete="false"
    />
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday-time@1.6.1/css/pikaday.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pikaday-time@1.6.1/pikaday.min.js"></script>
@endpush
