@extends("layouts.base")

@section("title", "Logbook | $post->title")

@section("content")

<!-- From PostController → show() => $post & $user -->
<article
    class="bg-white md:shadow-lg md:rounded-2xl p-6 sm:p-10 mx-auto mt-8 max-w-4xl flex flex-col items-center md:border-2 md:border-gray-200">

    <!-- Post Header -->
    <div class="w-full max-w-4xl mb-6 flex items-center justify-between pb-6 border-b border-gray-200">
        <!-- Left: Author Info -->
        <a href="" class="flex items-center space-x-3">
            <img
                src="{{ $post->author->avatar }}"
                alt="{{ $post->author->username }}"
                class="w-12 h-12 rounded-full border border-gray-300 object-cover" />

            <div>
                <p class="font-semibold text-gray-900 text-lg">
                    {{ $post->author->username }}
                </p>
                <p class="text-sm font-medium text-gray-500">
                    •
                    <span>{{ $post->published_at }}</span>
                </p>
            </div>
        </a>

        <!-- Right: Follow Button -->
        @auth
        @if (auth()->id())
        <form action="" method="POST">
            @csrf

            @if (auth()->user())
            <button
                class="px-4 py-2 text-sm font-semibold border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition">
                Following
            </button>
            @else
            <button
                class="px-4 py-2 text-sm font-semibold bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                Follow
            </button>
            @endif
        </form>
        @endif
        @endauth
    </div>

    <!-- Post Title -->
    <h1 class="text-2xl sm:text-3xl xl:text-4xl font-bold tracking-tight text-gray-900 text-center xl:text-left">
        {{ $post->title }}
    </h1>

    <!-- Post Image -->
    <div class="my-8 xl:my-10 flex justify-center w-full">
        <img
            class="w-full md:w-3/4 h-auto rounded-xl shadow-md object-cover"
            src="{{ $post->cover_image }}"
            alt="{{ $post->slug }}" />
    </div>

    <!-- Description Section -->
    <div class="w-full max-w-3xl space-y-6 text-gray-700 leading-relaxed text-base sm:text-lg mb-8">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">
            Description
        </h2>
        <p>
            {!! nl2br(e($post->description)) !!}
        </p>
    </div>

    <div class="w-full max-w-3xl mb-8">
        @include("post.partials.post-interaction")
    </div>

    <div class="w-full max-w-3xl mb-8">
        @include("post.partials.comment")
    </div>
</article>

@endsection