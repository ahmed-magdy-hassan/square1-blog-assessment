<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto flex flex-col sm:px-6 lg:px-8">
            <h2 class="my-4 font-semibold text-4xl text-gray-800 leading-tight font-sans">
                {{ $post->title }}
            </h2>

            <article class="bg-white px-4 py-2 rounded-lg w-full prose lg:prose-xl">
                {!! $post->description !!}
            </article>
        </div>
    </div>
</x-app-layout>
