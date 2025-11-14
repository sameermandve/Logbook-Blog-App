<div x-data="formLoading">
    <form action="" method="" @submit="start">
        @csrf
        <div class="w-full mb-4 border border-gray-200 rounded-xl bg-neutral-secondary-medium">
            <div class="px-4 py-2 bg-neutral-secondary-medium rounded-t-xl">
                <label for="text_comment" class="sr-only">Your comment</label>
                <textarea name="text_comment" id="text_comment" rows="4" class="block w-full px-0 text-base text-heading bg-neutral-secondary-medium border-0 focus:ring-0 placeholder:text-body" placeholder="Write a new comment..."></textarea>
            </div>
            <div class="flex flex-row-reverse items-center px-3 py-2 border-t border-gray-200">
                <x-secondary-button x-bind:disabled="loading" width="w-full sm:w-1/4" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
                    <span x-show="!loading">Post Comment</span>
                    <div x-show="loading" class="flex items-center justify-center">
                        <x-lucide-loader-circle class="size-6 animate-spin" />
                    </div>
                </x-secondary-button>
            </div>
        </div>
    </form>
</div>