<div>
    <div class="px-4 py-5 space-y-6 sm:p-6">
        <div class="col-span-6">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <input type="text" name="title" id="title" autocomplete="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            <x-jet-input-error for="title" class="mt-2" />
        </div>

        <div>
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="description..."></textarea>
            <x-jet-input-error for="description" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-jet-label for="publication_date" value="{{ __('Publication Date') }}" />
            <x-input.date-time id="publication_date" name="publication_date" :value='old("publication_date", $instructor->publication_date ?? null)'></x-input.date>
            <x-jet-input-error for="publication_date" class="mt-2" />
        </div>

    </div>
</div>