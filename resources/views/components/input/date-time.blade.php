<div
    @if($attributes->get('wire:model'))
    x-data="{ value: @entangle($attributes->wire('model')), picker: undefined}"
    @else
    x-data="{ value: '{{ $attributes->get('value') }}', picker: undefined}"
    @endif
    x-init="new Pikaday({
        field: $refs.input,
        format: 'dd-mm-YYYY HH:mm:ss',
        showTime: true,
        onOpen() { this.setDate($refs.input.value) },
        toString(date, format) {
            // you should do formatting based on the passed format,
            // but we will just return 'dd-mm-YYYY HH:mm:ss' for simplicity
            let seconds = date.getSeconds();
            let minutes = date.getMinutes();
            let hour = date.getHours();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();

            if(seconds < 10){
                seconds =  '0' + seconds;
            }

            if(minutes < 10){
                minutes =  '0' + minutes;
            }

            if(hour < 10){
                hour =  '0' + hour;
            }

            return `${year}-${month}-${day} ${hour}:${minutes}:${seconds}`;
        },
        parse(dateTimeString, format) {
            // dateTimeString is the result of `toString` method

            const parts = dateTimeString.split(' ');

            const date = parts[0].split('-');
            const time = parts[1].split(':');

            const seconds = parseInt(time[2], 10);
            const minutes = parseInt(time[1], 10);
            const hour = parseInt(time[0], 10);

            const day = parseInt(date[0], 10);
            const month = parseInt(date[1], 10) - 1;
            const year = parseInt(date[2], 10);
            return new Date(year, month, day, hours, minutes);
        }
    })"
    x-on:change="value = $event.target.value"
    class="mt-1 flex rounded-md shadow-sm relative"
>
    <span class="inline-flex items-center px-3 py-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </span>

    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        class="rounded-none rounded-r-md border flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    />
</div>

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday-time@1.6.1/css/pikaday.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pikaday-time@1.6.1/pikaday.min.js"></script>
@endpush
