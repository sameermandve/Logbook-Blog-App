@extends("layouts.default")

@section("title", "Logboook | Create post")

<!-- View => From PostController → editPostForm() -->
<!-- Action => From PostController → editPost() -->
@section("main")
<div class="flex justify-center items-center lg:shadow-md lg:border-2 lg:border-gray-300 sm:rounded-2xl mt-8">
    <div class="flex flex-col w-full p-6 lg:p-8">
        <div class="mb-1">
            <x-heading class="text-center">Edit Post</x-heading>

            @if (session()->has("error-edit-post"))
            <x-alert class="text-error-800 bg-error-50 mt-4">
                {{ session()->get("error-edit-post") }}
            </x-alert>
            @endif
        </div>

        <div x-data="formLoading" class="pt-8 pb-4">
            <!-- Form content goes here -->
            <form action="{{ route("post.edit", [$username, $post->slug]) }}" method="post" class="space-y-6" @submit="start" enctype="multipart/form-data">
                @csrf
                @method("PATCH")

                <!-- Post Previous Image -->
                <div class="mb-8 xl:mb-10 flex justify-center w-full">
                    <img
                        class="w-full md:w-3/4 h-auto rounded-xl shadow-md object-cover"
                        src="{{ $post->cover_image }}"
                        alt="{{ $post->slug }}" />
                </div>

                <!-- Post Title -->
                <div>
                    <x-input-label for="title">Title</x-input-label>
                    <x-text-input type="text" name="title" id="title" class="block mt-2 w-full" value="{{ $post->title }}" />
                    @error("title")
                    <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>

                <!-- Post Cover Image -->
                <div>
                    <x-input-label for="cover_image">Upload Image</x-input-label>
                    <x-file-input name="cover_image" id="cover_image" />
                    @error("cover_image")
                    <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>

                <!-- Post description -->
                <div>
                    <x-input-label for="description">Description</x-input-label>
                    <x-textarea name="description"
                        id="description"
                        class="block mt-2 w-full"
                    >{{ $post->description }}</x-textarea>
                    @error("description")
                    <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>

                <!-- Submit Button -->
                <x-primary-button x-bind:disabled="loading" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
                    <span x-show="!loading">Update post</span>
                    <div x-show="loading" class="flex items-center justify-center">
                        <x-lucide-loader-circle class="size-6 animate-spin" />
                    </div>
                </x-primary-button>
            </form>
        </div>
    </div>
</div>
@endsection