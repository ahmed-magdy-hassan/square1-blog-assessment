<div class="flex-grow mb-8">
    <div class="flex items-center justify-end">
        <div class="ml-3 relative flex items-center space-x-2">
            <x-jet-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            Sort
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </x-slot>

                <x-slot name="content">

                    <x-jet-dropdown-link wire:click.prevent="sortByDirection('publication_date','asc')">
                        {{ __('Oldest') }}
                    </x-jet-dropdown-link>

                    <x-jet-dropdown-link wire:click.prevent="sortByDirection('publication_date','desc')">
                        {{ __('Newest') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
            <span class="inline-flex rounded-md">
                <button wire:click.prevent="sortByDirection('publication_date')" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                    Rest
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-0.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </span>
        </div>
    </div>
    <div class="divide-y divide-gray-200">
        @forelse ($rows as $post)
            <div class="py-12">
                <article class="space-y-2 gap-4 xl:grid xl:grid-cols-4 xl:space-y-0">
                    <div class="flex flex-col">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-14 w-14">
                                <img class="h-14 w-14 rounded-full" src="{{$post->user->profile_photo_url}}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-base font-medium text-gray-900">{{$post->user->name}}</div>
                                <div class="text-sm text-gray-500">
                                    <dl>
                                        <dt class="sr-only">Published on</dt>
                                        <dd class="leading-6 font-light">
                                            <time datetime="Friday, May 15, 2020">{{$post->formated_publication_date}}</time>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-5 xl:col-span-3">
                        <div class="space-y-6">
                            <h2 class="text-2xl leading-8 font-bold tracking-tight">
                                <a class="text-gray-900 hover:text-blue-700 font-sans" href="{{route('posts.show',$post->id)}}">{{$post->title}}</a>
                            </h2>
                            <article class="bg-white px-4 py-2 rounded-lg w-full prose">
                                {{$post->short_description}}
                            </article>
                        </div>
                        <div class="text-base leading-6 font-medium">
                            <a class="text-blue-500 hover:text-blue-600 flex space-x-1 items-center" aria-label="Read &quot;Connecting Multiple Platforms Together&quot;" href="{{route('posts.show',$post->id)}}">
                                <span>
                                    {{__('Read more')}}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="flex items-center justify-center space-x-2">
                <span class="py-8 text-xl font-medium text-cool-gray-400">{{ __('No posts found') }}</span>
            </div>
        @endforelse
    </div>
    <div>
        {{ $rows->links() }}
    </div>
</div>
