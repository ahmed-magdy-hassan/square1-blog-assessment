<div>
    <div class="py-5 space-y-5">
        <!-- Top Bar -->
        <div class="flex justify-between">
            <div class="flex w-2/4 space-x-4">
                <div class="col-span-3 sm:col-span-2">
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                      </span>
                      <input type="text" wire:model.debounce.500ms="filters.search" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Search Admin...">
                    </div>
                </div>

                <x-button.link wire:click="toggleShowFilters">
                    @if ($showFilters) {{ __('Hide') }} @endif {{ __('Advanced Search...') }} 
                </x-button.link>
            </div>

            <div class="flex items-center space-x-2">
                <x-input.group borderless paddingless for="perPage" label="{{__('Per Page')}}">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="{{ __('Bulk Actions') }}">
                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>{{ __('Delete') }}</span>
                    </x-dropdown.item>
                </x-dropdown>


                <x-link.primary href="{{ route('users.create') }}" class="bg-green-600 hover:bg-green-500 active:bg-green-700 border-green-600"><x-icon.plus/> {{ __('New') }}</x-link.primary>
            </div>
        </div>

        <!-- Advanced Search -->
        @if ($showFilters)
            <div>
                <div class="relative flex px-4 py-8 rounded-md shadow-inner bg-white">
                    <div class="w-1/2 pr-2 space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="text" wire:model.debounce.500ms="filters.email" name="email" id="email" autocomplete="email" placeholder="example@example.com" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">        
                        </div>
                        <x-button.link wire:click="resetFilters" class="absolute bottom-0 right-0">{{ __('Reset Filters') }}</x-button.link>
                    </div>
                </div>
            </div>
        @endif

        <!-- User Table -->
        <div class="flex-col space-y-4">

            <x-table>
                <x-slot name="head">
                    <x-table.heading class="w-8 pr-0">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">{{ __('Name') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email')" :direction="$sorts['email'] ?? null">{{ __('Email') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('email_verified_at')" :direction="$sorts['email_verified_at'] ?? null">{{ __('Verified') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('role')" :direction="$sorts['role'] ?? null">{{ __('Role') }}</x-table.heading>
                    <x-table.heading />
                </x-slot>

                <x-slot name="body">
                    @if ($selectPage)
                        <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                            <x-table.cell colspan="7">
                                @unless ($selectAll)
                                    <div>
                                        <span>{{ __('You have selected') }} <strong>{{ $rows->count() }}</strong> {{ __('users, do you want to select all') }} <strong>{{ $rows->total() }}</strong>?</span>
                                        <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">{{ __('Select All') }}</x-button.link>
                                    </div>
                                @else
                                    <span>{{ __('You are currently selecting all') }} <strong>{{ $rows->total() }}</strong>{{ __('users') }} .</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endif

                    @forelse ($rows as $row)
                        <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $row->id }}">
                                <x-table.cell class="pr-0">
                                    <x-input.checkbox wire:model="selected" value="{{ $row->id }}" />
                                </x-table.cell>

                            <x-table.cell>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                      <img class="h-10 w-10 rounded-full" src="{{$row->profile_photo_url}}" alt="profile image for {{$row->name}}">
                                    </div>
                                    <div class="ml-4">
                                      <div class="text-sm font-medium text-gray-900">
                                        {{ $row->name }}
                                      </div>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <span >{{ $row->email }}</span>
                            </x-table.cell>

                            <x-table.cell>
                                @if(empty($row->email_verified_at))
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                        {{ __('Unverified') }}
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                        {{ __('Verified') }}
                                    </span>
                                @endif
                            </x-table.cell>
                            
                            <x-table.cell>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                   {{$row->role_label}}
                                </span>
                            </x-table.cell>

                            <x-table.cell>
                                <x-link.secondary href="{{route('users.edit',$row->id)}}" >{{ __('Edit') }}</x-link.secondary>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="7">
                                <div class="flex items-center justify-center space-x-2">
                                    <x-icon.no-record class="w-8 h-8 text-cool-gray-400" />
                                    <span class="py-8 text-xl font-medium text-cool-gray-400">{{ __('No record found') }}</span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>

            <div>
                {{ $rows->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Users Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">
                {{ __('Delete User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to continue? This action is irreversible') }}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">{{ __('Cancel') }}</x-button.secondary>

                <x-button.red type="submit">{{ __('Delete') }}</x-button.red>
            </x-slot>
        </x-modal.confirmation>
    </form>

    <!-- Verify Users Modal -->
    <form wire:submit.prevent="verifySelected">
        <x-modal.confirmation wire:model.defer="showVerifyModal">
            <x-slot name="title">
                {{ __('Verify Users') }}
            </x-slot>
            <x-slot name="content">
                {{ __('Are you sure you want to continue? This action is irreversible') }}
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showVerifyModal', false)">{{ __('Cancel') }}</x-button.secondary>
                <x-button.red type="submit">{{ __('Verify') }}</x-button.red>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
