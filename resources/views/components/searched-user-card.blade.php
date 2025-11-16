@props(["searchedUser"])

<div class="w-full bg-white shadow-lg rounded-2xl p-6 flex items-center space-x-6 border border-gray-200">
    <!-- Profile Image -->
    <img
        src="{{ $searchedUser->avatar }}"
        alt="{{ $searchedUser->username }}"
        class="w-20 h-20 rounded-full object-cover shadow-md">

    <!-- User Info -->
    <div class="flex-1">
        <a href="{{ route("profile.show", $searchedUser->username) }}" class="text-xl font-bold text-gray-800 hover:text-gray-900">
            {{ $searchedUser->username }}
        </a>

        <p class="text-gray-600 text-sm">
            {{ $searchedUser->email }}
        </p>
    </div>

    <!-- Follow Button -->
    <button
        class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-xl shadow hover:bg-primary-500 active:bg-primary-700 transition">
        Follow
    </button>
</div>