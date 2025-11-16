@extends("layouts.default")

@section("title", "Logbook | Search")

@section("main")
<div class="w-full mt-12 flex flex-col space-y-10 items-center">
    <!-- View => SearchController → searchForm() -->
    <!-- Action => SearchController → getSearchedUser() -->
    <form x-data="{...formLoading(), search: ''}" action="{{ route("search.get") }}" method="get" x-init="$nextTick(() => $refs.input.focus())" @focus.window="$refs.input.focus()" class="w-full max-w-2xl" @submit="start">
        <label for="search" class="block mb-2.5 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input x-ref="input" x-model="search" type="search" name="search" id="search" class="block w-full p-3 ps-9 bg-neutral-secondary-medium border-2 border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-primary-700 focus:border-primary-700 shadow-md placeholder:text-body" placeholder="Search" />
            <button :disabled="loading || search === ''" x-bind:class="(search === '' || loading)  ? 'cursor-not-allowed' : 'cursor-default'" type="submit" class="absolute box-border end-1.5 bottom-1.5 text-white shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 bg-primary-600 border border-transparent uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <span x-show="!loading">Search</span>
                <div x-show="loading" class="flex items-center justify-center">
                    <x-lucide-loader-circle class="size-6 animate-spin" />
                </div>
            </button>
        </div>
    </form>

    <!-- From SearchController → getSearchedUser() => $searchedUser -->
    @if (request()->has("search"))
    <div class="w-full max-w-2xl flex items-center justify-center">
        @if($searchedUser)
        <x-searched-user-card :searchedUser="$searchedUser" />
        @endif
    </div>
    @endif
</div>
@endsection