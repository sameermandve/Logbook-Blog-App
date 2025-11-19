@extends("layouts.base")

@section("content")
<div class="space-y-8 mt-8 sm:mt-10 flex flex-col p-4 sm:p-0">
    <div class="mb-1">
        @if (session()->has("success-delete"))
        <x-toast-success>
            {{ session()->get("success-delete") }}
        </x-toast-success>
        @endif

        @if (session()->has("error-delete"))
        <x-toast-error>
            {{ session()->get("error-delete") }}
        </x-toast-error>
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