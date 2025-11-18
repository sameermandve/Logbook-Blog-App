@extends("layouts.base")

@section("content")
<div class="space-y-8 mt-8 sm:mt-10 flex flex-col p-4 sm:p-0">
    <div class="mb-1">
        @if (session()->has("success-delete"))
        <x-alert class="text-success-800 bg-success-50 mt-4">
            {{ session()->get("success-delete") }}
        </x-alert>
        @endif

        @if (session()->has("error-delete"))
        <x-alert class="text-error-800 bg-error-50 mt-4">
            {{ session()->get("error-delete") }}
        </x-alert>
        @endif
    </div>


    <!-- From PostController → index() -->
    @forelse ($posts as $post)
    <x-post :post="$post" />
    @empty
    <x-no-post />
    @endforelse

    <div class="my-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection