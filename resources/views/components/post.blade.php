@props(['post'])

<div class="flex flex-col-reverse sm:flex-row bg-white border border-gray-200 rounded-lg shadow-sm mb-8">
    <div class="p-5 flex-1">
        <a href="#">
            <h5 class="mb-2 text-xl sm:text-2xl font-heading font-bold tracking-tight text-gray-900">
                {{ $post->title }}
            </h5>
        </a>
        <div class="mb-3 text-sm sm:text-base text-gray-700 leading-relaxed">
            {{ Str::words($post->description, 30) }}
        </div>
        <a href="{{ route("post.show", $post->slug) }}">
            <x-secondary-button width="md:w-1/4">
                <div class="flex items-center justify-center text-sm">
                    <span>Read more</span>
                    <x-lucide-arrow-right class="size-4 ms-2" />
                </div>
            </x-secondary-button>
        </a>
    </div>
    <a href="#">
        <img class="w-full sm:w-60 h-48 sm:h-full object-cover sm:rounded-r-lg rounded-t-lg sm:rounded-tl-none" src="{{ $post->cover_image }}"
            alt="{{ $post->slug }}" />
    </a>
</div>
