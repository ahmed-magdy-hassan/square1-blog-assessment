@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }} class="overflow-visible">
    <div class="px-6 py-4">
        <div class="text-lg">
            <!-- Title -->
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 text-right">
        {{ $footer }}
    </div>
</x-modal>
