@extends("layouts.base")

@section("title", "Logbook | $post->title")

@section("content")

<article
    class="bg-white sm:shadow-lg sm:rounded-2xl p-6 sm:p-10 mx-auto max-w-4xl flex flex-col items-center border-2">

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