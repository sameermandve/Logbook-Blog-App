<div class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded-xl shadow-sm p-10 text-center mt-6 mb-8 w-full max-w-3xl mx-auto">
    <div class="bg-gray-300 p-4 rounded-full mb-4 animate-pulse text-gray-500">
        <x-lucide-file-x class="w-10 h-10 text-gray-500" />
    </div>
    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-1">
        No posts available
    </h3>
    <p class="text-gray-500 text-sm sm:text-base mb-6">
        It looks like there are no posts to display right now.
    </p>
    <a href="{{ route('post.form') }}">
        <x-secondary-button class="px-5 py-2 text-sm sm:text-base rounded-lg">
            <div class="flex items-center justify-center">
                <x-lucide-plus class="w-4 h-4 mr-2" />
                <span>Create a Post</span>
            </div>
        </x-secondary-button>
    </a>
</div>