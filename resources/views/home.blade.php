@extends("layouts.base")

@section("content")
<div class="space-y-8 mt-8 sm:mt-12 flex flex-col p-4 sm:p-0">
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
