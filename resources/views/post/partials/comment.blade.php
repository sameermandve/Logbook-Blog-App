

<form>
    <div class="w-full mb-4 border border-gray-200 rounded-xl bg-neutral-secondary-medium">
        <div class="px-4 py-2 bg-neutral-secondary-medium rounded-t-xl">
            <label for="text_comment" class="sr-only">Your comment</label>
            <textarea name="text_comment" id="text_comment" rows="4" class="block w-full px-0 text-base text-heading bg-neutral-secondary-medium border-0 focus:ring-0 placeholder:text-body" placeholder="Write a new comment..." required></textarea>
        </div>
        <div class="flex flex-row-reverse items-center px-3 py-2 border-t border-gray-200">
            <x-secondary-button width="w-1/4">Post comment</x-secondary-button>
        </div>
    </div>
</form>