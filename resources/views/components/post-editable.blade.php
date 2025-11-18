@props(['user', 'post'])

<div x-data="{ open: false }" class="relative flex flex-col items-end">

    <button type="button"
        @click="open = !open"
        class="flex items-center justify-center text-white bg-primary-700 rounded-full size-10 hover:bg-primary-800 border-2 border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:outline-none transition">
        <x-lucide-ellipsis-vertical class="size-5 text-white" />
    </button>

    <!-- Edit or delete button panel -->
    <div x-show="open" @click.away="open=false" x-transition id="post-options-menu"
        class="absolute top-14 right-0 bg-gray-100 shadow-lg border-2 border-gray-200 rounded-xl p-3 space-y-2 w-36">

        <!-- Edit -->
        <a href="{{ route("post.edit.form", [$user->username, $post->slug]) }}"
            class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-200 text-gray-700">
            <x-lucide-pencil class="size-4" />
            <span>Edit</span>
        </a>

        <!-- Delete -->
        <form method="POST" action="{{ route("post.delete", [$user->username, $post->slug]) }}">
            @csrf
            @method("DELETE")
            <button type="submit"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-red-100 text-red-600 w-full">
                <x-lucide-trash class="size-4" />
                <span>Delete</span>
            </button>
        </form>
    </div>
</div>