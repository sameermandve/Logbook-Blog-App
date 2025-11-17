@props(['post'])

<div x-data="{
        likes_count: {{ $post->likedByUsers()->count() }},
        loading: false,
        isLiked: {{ Auth::user()->hasLiked($post) ? 'true' : 'false' }},
        toggleLike () {
            this.loading = true;

            axios.post('{{ route("post.like", [$post->author->username, $post->slug]) }}')
                .then(response => {
                    this.likes_count = response.data.likes_count;
                    this.isLiked = response.data.isLiked;
                })
                .catch(err => {
                    console.error(err);
                })
                .finally(() => {
                    this.loading = false;
                })
        }
    }" class="flex-1 flex items-center justify-center">
    <button @click="toggleLike()" class="flex items-center justify-center">
        <template x-if="isLiked && !loading">
            <x-lucide-heart fill="currentColor" stroke-width="0" class="size-6 text-error-500 hover:text-error-600 hover:scale-105" />
        </template>

        <template x-if="loading">
            <x-lucide-loader-circle x-show="loading" class="size-6 text-error-500 animate-spin" />
        </template>

        <template x-if="!isLiked && !loading">
            <x-lucide-heart class="size-6 text-error-500 hover:text-error-600 hover:scale-105" />
        </template>

        <span class="text-gray-500 text-lg font-semibold ms-2" x-text="likes_count"></span>
        <span class="text-gray-500 text-lg font-semibold ms-2">likes</span>
    </button>
</div>
