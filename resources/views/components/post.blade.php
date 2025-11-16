@props(['post'])

<div class="flex flex-col lg:flex-row bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mb-8 mt-4">

    {{-- Thumbnail --}}
    <a href="{{ route('post.show', $post->slug) }}" class="block w-full lg:w-64 shrink-0">
        <img
            src="{{ $post->cover_image ?: '/placeholder.png' }}"
            alt="{{ $post->slug }}"
            class="w-full h-52 md:h-72 lg:h-full object-cover lg:rounded-l-2xl">
    </a>

    {{-- Content --}}
    <div class="flex-1 p-5 flex flex-col justify-between space-y-4">

        {{-- Title --}}
        <a href="{{ route('post.show', $post->slug) }}">
            <h2 class="text-xl md:text-2xl font-heading font-bold tracking-tight text-gray-900 hover:text-primary-700 transition">
                {{ $post->title }}
            </h2>
        </a>

        {{-- Description --}}
        <p class="text-sm md:text-base text-gray-700 leading-relaxed">
            {{ Str::words($post->description, 30) }}
        </p>

        <!-- Author and published date -->
        <p class="text-xs md:text-sm font-medium text-gray-600 leading-tight mb-2 xl:mb-0">
            published by 
            <a href="{{ route("profile.show", $post->author->username) }}">
            <span class="hover:underline text-gray-900">{{ $post->author->username }}</span>
            </a> on
            {{ $post->published_at }}
        </p>

        {{-- Read More Button --}}
        <a href="{{ route("post.show", $post->slug) }}" x-data="formLoading" @click="start" class="pt-2 flex justify-end">
            <x-secondary-button
                x-data="formLoading"
                @click="start"
                x-bind:disabled="loading"
                width="w-full xl:w-1/3"
                class="flex items-center justify-center"
                x-bind:class="loading ? 'cursor-not-allowed opacity-75' : 'cursor-default'">
                <div x-show="!loading" class="flex items-center justify-center text-sm">
                    <span>Read more</span>
                    <x-lucide-arrow-right class="size-5 ms-2" />
                </div>

                <div x-show="loading" class="flex items-center justify-center">
                    <x-lucide-loader-circle class="size-6 animate-spin" />
                </div>
            </x-secondary-button>
        </a>

    </div>
</div>