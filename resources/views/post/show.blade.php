@extends("layouts.base")

@section("title", "Logbook | $post->title")

@section("content")

<!-- From PostController → show() => $post & $user -->
<article x-data="followUnfollow({
    isFollowing: {{ $post->author->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
    followers_count: {{ $post->author->followers()->count() }},
    following_count: {{ $post->author->following()->count() }},
    url: '{{ route("user.follow", $post->author->id) }}',
})"
    class="bg-white md:shadow-lg md:rounded-2xl p-4 sm:p-10 mx-auto mt-8 max-w-4xl flex flex-col items-center md:border-2 md:border-gray-200">

    <!-- Post Header -->
    <div class="w-full max-w-4xl mb-6 flex items-center justify-between pb-6 border-b border-gray-200">
        <!-- Left: Author Info -->
        <a href="{{ route("profile.show", $post->author->username) }}" class="flex items-center space-x-3">
            <img
                src="{{ $post->author->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}"
                alt="{{ $post->author->username }}"
                class="size-12 md:size-15 rounded-full border border-gray-300 object-cover" />

            <div>
                <p class="text-base sm:text-lg font-semibold text-gray-900">
                    {{ $post->author->username }}
                </p>
                <p class="text-xs md:text-sm font-medium text-gray-500">
                    •
                    <span>{{ $post->published_at }}</span>
                </p>
            </div>
        </a>

        <!-- Right: Follow Button -->
        @auth
        @if (Auth::user()->id !== $post->author->id)
        <button @click="toggleFollow" :class="isFollowing ? 'bg-error-600 hover:bg-error-500 active:bg-error-700 focus:ring-error-500' : 'bg-primary-600 hover:bg-primary-500 active:bg-primary-700 focus:ring-primary-500' " class="w-[103px] md:w-1/6 font-semibold rounded-lg leading-5 text-xs px-3 py-2 lg:py-1.5 items-center text-white border border-transparent uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
            <template x-if="!isFollowing && !loading">
                <span>Follow</span>
            </template>

            <template x-if="loading">
                <div class="flex items-center justify-center w-full">
                    <x-lucide-loader-circle x-show="loading" class="size-5 text-center text-white animate-spin" />
                </div>
            </template>

            <template x-if="isFollowing && !loading">
                <span>Unfollow</span>
            </template>
        </button>
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
        <div class="w-full flex items-center">

            <!-- Like Button Section -->
            <x-like :post="$post" />

            <!-- Comment Button Section -->
            <div class="flex-1 flex items-center justify-center border-l-2 border-gray-300">
                <x-lucide-message-circle-more class="size-6 text-gray-500 hover:text-gray-600 hover:scale-105" />
                <span class="text-gray-500 text-lg font-semibold ms-2">30 comments</span>
            </div>
        </div>
    </div>

    <div class="w-full max-w-3xl mb-8">
        @include("post.partials.comment")
    </div>
</article>

@endsection