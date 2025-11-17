@props(["searchedUser"])

<div x-data="followUnfollow({
    isFollowing: {{ $searchedUser->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
    followers_count: {{ $searchedUser->followers()->count() }},
    following_count: {{ $searchedUser->following()->count() }},
    url: '{{ route("user.follow", $searchedUser->id) }}',
})" class="w-full bg-white shadow-lg rounded-2xl p-4 flex items-center space-x-5 border border-gray-200">
    <!-- Profile Image -->
    <img
        src="{{ $searchedUser->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}"
        alt="{{ $searchedUser->username }}"
        class="size-12 md:size-18 rounded-full object-cover shadow-md">

    <!-- User Info -->
    <div class="flex-1 mr-4">
        <a href="{{ route("profile.show", $searchedUser->username) }}" class="text-base md:text-xl font-bold text-gray-800 hover:text-gray-900">
            {{ $searchedUser->username }}
        </a>

        <p class="text-gray-600 text-xs md:text-sm text-wrap">
            {{ $searchedUser->email }}
        </p>
    </div>

    <!-- Follow Button -->
    <button @click="toggleFollow" :class="isFollowing ? 'bg-error-600 hover:bg-error-500 active:bg-error-700 focus:ring-error-500' : 'bg-primary-600 hover:bg-primary-500 active:bg-primary-700 focus:ring-primary-500' "
        class="w-1/5 lg:w-[105px] font-semibold rounded-lg leading-5 text-xs px-2 md:px-3 py-2 lg:py-1.5 items-center text-white border border-transparent capitalize md:uppercase tracking-tighter md:tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
        <template x-if="!isFollowing && !loading">
            <span>Follow</span>
        </template>

        <template x-if="loading">
            <div class="flex items-center justify-center w-full">
                <x-lucide-loader-circle x-show="loading" class="size-5 text-white animate-spin" />
            </div>
        </template>

        <template x-if="isFollowing && !loading">
            <span>Unfollow</span>
        </template>
    </button>
</div>