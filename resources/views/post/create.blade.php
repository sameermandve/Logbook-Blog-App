@extends("layouts.default")

@section("title", "Logboook | Create post")

@section("main")
<div class="flex justify-center items-center lg:shadow sm:rounded-2xl">
    <div class="flex flex-col w-full p-6 lg:p-8">
        <div class="mb-1">
            <x-heading class="text-center">Create New Post</x-heading>

            @if (session()->has("success-post"))
            <x-alert class="text-success-800 bg-success-50 mt-4">
                {{ session()->get("success-post") }}
            </x-alert>
            @endif

            @if (session()->has("error-post"))
            <x-alert class="text-error-800 bg-error-50 mt-4">
                {{ session()->get("error-post") }}
            </x-alert>
            @endif
        </div>

        <div class="pt-8 pb-4">
            <!-- Form content goes here -->
            <form action="{{ route("post.create") }}" method="post" class="space-y-6" enctype="multipart/form-data">
                @csrf
                <!-- Post Title -->
                <div>
                    <x-input-label for="title">Title</x-input-label>
                    <x-text-input type="text" name="title" id="title" class="block mt-2 w-full" placeholder="Post title" value="{{ old('title') }}" />
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
                    <x-textarea name="description" id="description" class="block mt-2 w-full" placeholder="Write a short description about the post..." value="{{ old('description') }}" />
                    @error("description")
                    <x-input-error>{{ $message }}</x-input-error>
                    @enderror
                </div>

                <!-- Submit Button -->
                <x-primary-button>Create new post</x-primary-button>
            </form>
        </div>
    </div>
</div>
@endsection