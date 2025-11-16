@props(['user', 'posts'])

<section x-data="{tab: 'home'}" class="space-y-8 mt-8 sm:mt-12 w-full flex flex-col-reverse lg:flex-row p-4 bg-white md:shadow-xl md:border-2 border-gray-300 rounded-2xl">
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

        <div x-show="tab==='home'" class="flex flex-col space-y-8">
            @forelse ($posts as $post)
            <x-post :post="$post" />
            @empty
            <x-no-post />
            @endforelse
        </div>

        <div x-show="tab==='about'" class="flex flex-col space-y-8 ml-2 mt-2">
            <p class="text-gray-600 font-medium tracking-wide">
                {{ $user->bio ?: "No bio added yet!" }}
            </p>

            <p class="text-sm font-medium text-gray-600 tracking-wide">303K Followers | 48 Following</p>

            <p class="text-sm font-medium text-gray-500 tracking-wide">Member since {{ $user->created_at->format("M Y") }}</p>
        </div>
    </div>

    <div class="hidden lg:block w-px bg-gray-300 m-4"></div>

    <!-- Top & Right side -->
    <div class="lg:w-[300px] flex flex-col md:p-4 space-y-8 mb-8 lg:mb-0">
        <!-- Profile avatar -->
        <!-- <div class="rounded-full size-30 shadow-md border-2 border-gray-200">
            <img class="size-30 rounded-full object-cover" src="{{ $user->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}" alt="{{ $user->username }}">
        </div> -->
        <img class="size-30 rounded-full object-cover border-2 border-gray-300" src="{{ $user->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}" alt="{{ $user->username }}">

        <!-- Profile info -->
        <div class="flex flex-col space-y-4 pl-1">
            <h1 class="text-gray-900 font-heading text-base lg:text-xl font-semibold">
                <span>@</span>{{ $user->username }}
            </h1>
            <p class="text-sm font-medium text-gray-600">303K Followers | 48 Following</p>
        </div>

        <div class="flex flex-col space-y-6 pl-1">
            <p class="text-sm font-medium text-gray-600 tracking-tight leading-6 md:leading-5">{{ $user->bio }}</p>

            <x-secondary-button width="lg:w-1/3" px="px-3" py="lg:py-1.5 py-2" class="leading-5 text-xs">Follow</x-secondary-button>
        </div>
    </div>
</section>