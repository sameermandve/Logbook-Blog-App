@props(['post', 'user'])

<div class="flex flex-col space-y-6 pt-2 w-full">
    @foreach ($post->comments as $comment)
    <div class="flex items-start justify-start  {{ Auth::user()->id === $comment->user->id ? 'flex-row-reverse' : '' }} gap-2.5">
        <img class="w-8 h-8 rounded-full" src="{{ $comment->user->avatar ?: 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}" alt="{{ $comment->user->username }}">
        <div class="flex flex-col gap-2 w-fit max-w-[75%]">
            <div class="flex items-center gap-2 rtl:space-x-reverse {{ Auth::user()->id === $comment->user->id ? 'flex-row-reverse' : '' }}">
                <a href="{{ route("profile.show", $comment->user->username) }}"
                    class="text-sm font-semibold text-heading hover:underline text-gray-800 hover:text-gray-900">
                    {{ $comment->user->username }}
                </a>
                <span class="text-xs font-medium text-gray-500 text-body">{{ $comment->created_at->format("h:i") }}</span>
            </div>
            <div class="flex {{ Auth::user()->id === $comment->user->id ? 'justify-end' : 'justify-start' }} leading-1.5 p-4 bg-gray-100 rounded-lg">
                <p class="text-sm text-body">{{ $comment->comment_content }}</p>
            </div>
        </div>

        @if ($post->author->id === Auth::user()->id || Auth::user()->id === $comment->user->id)
        <form x-data="formLoading"
            action="{{ route("post.comment.delete", [$post->author->username, $post->slug, $comment->id]) }}"
            method="post"
            class="inline-flex self-center"
            @submit="start">
            @csrf
            @method('DELETE')
            <button type="submit">
                <x-lucide-trash-2 x-show="!loading" class="size-5 text-error-600 hover:text-red-500 hover:scale-105" />
                <x-lucide-loader-circle x-show="loading" class="size-5 text-error-600 hover:text-red-500 animate-spin cursor-not-allowed" />
            </button>
        </form>
        @endif
    </div>
    @endforeach
</div>