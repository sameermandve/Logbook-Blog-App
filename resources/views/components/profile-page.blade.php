@props(['user', 'posts'])

<section x-data="{
    tab: 'home',
    ...followUnfollow({
        isFollowing: {{ $user->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
        followers_count: {{ $user->followers()->count() }},
        following_count: {{ $user->following()->count() }},
        url: '{{ route("user.follow", $user->id) }}',
    })
}" class="space-y-8 mt-8 sm:mt-12 w-full flex flex-col-reverse lg:flex-row p-4 bg-white md:shadow-xl md:border-2 border-gray-300 rounded-2xl">
    <!-- Bottom & Left side -->
    <div class="lg:flex-1 flex flex-col md:p-4 space-y-6">
        <!-- Tabs -->
        <div class="text-base font-medium text-center text-gray-500 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px">
                <li class="me-2">
                    <button @click="tab='home'" :class="tab==='home' ? 'text-primary-700 border-primary-700' : 'text-gray-700 hover:text-gray-900 hover:border-gray-700'" class="inline-block p-4 border-b border-transparent rounded-t-base transition">
                        Home
                    </button>
                </li>
                <li class="me-2">
                    <button @click="tab='about'" :class="tab==='about' ? 'text-primary-700 border-primary-700' : 'text-gray-700 hover:text-gray-900 hover:border-gray-700'" class="inline-block p-4 border-b border-transparent rounded-t-base transition">
                        About
                    </button>
                </li>
            </ul>
        </div>

        <!-- From ProfileController → showUserProfile() & selfProfileShow() -->
        <div x-show="tab==='home'" class="flex flex-col justify-between space-y-8">
            @forelse ($posts as $post)
            <x-post :post="$post" />
            @empty
            <x-no-post />
            @endforelse
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>

        <div x-show="tab==='about'" class="flex flex-col space-y-8 ml-2 mt-2">
            <p class="text-gray-600 font-medium tracking-wide">
                {{ $user->bio ?: "No bio added yet!" }}
            </p>

            <p class="text-sm font-medium text-gray-600 tracking-wide">
                <span x-text="followers_count"></span> Followers | 
                <span x-text="following_count"></span> Following
            </p>

            <p class="text-sm font-medium text-gray-500 tracking-wide">Member since {{ $user->created_at->format("M Y") }}</p>
        </div>
    </div>

    <div class="hidden lg:block w-px bg-gray-300 m-4"></div>

    <!-- Top & Right side -->
    <!-- x-data => Inside [resources → js → app.js] -->
    <div class="lg:w-[300px] flex flex-col md:p-4 space-y-8 mb-8 lg:mb-0">
        <!-- Profile avatar -->
        <img class="size-30 rounded-full object-cover border-2 border-gray-300" src="{{ $user->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}" alt="{{ $user->username }}">

        <!-- Profile info -->
        <div class="flex flex-col space-y-4 pl-1">
            <h1 class="text-gray-900 font-heading text-base lg:text-xl font-semibold">
                <span>@</span>{{ $user->username }}
            </h1>
            <p class="text-sm font-medium text-gray-600">
                <span x-text="followers_count"></span> Followers |
                <span x-text="following_count"></span> Following
            </p>
        </div>

        <div class="flex flex-col space-y-6 pl-1">
            <p class="text-sm font-medium text-gray-600 tracking-tight leading-6 md:leading-5">{{ $user->bio }}</p>

            @if ($user->id !== Auth::user()->id)
            <button @click="toggleFollow" :class="isFollowing ? 'bg-error-600 hover:bg-error-500 active:bg-error-700 focus:ring-error-500' : 'bg-primary-600 hover:bg-primary-500 active:bg-primary-700 focus:ring-primary-500' " class="lg:w-1/2 font-semibold rounded-lg leading-5 text-xs px-3 py-2 lg:py-1.5 items-center text-white border border-transparent uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">
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
            @else
            <a href="{{ route("search") }}">
                <x-secondary-button width="lg:w-full" py="py-2 lg:py-1.5">Search for users</x-secondary-button>
            </a>
            @endif
        </div>
    </div>
</section>