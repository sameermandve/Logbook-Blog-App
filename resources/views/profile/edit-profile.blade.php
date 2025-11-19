@extends("layouts.default")

@section("title", "Logboook | Profile")

@section("main")

@if (session()->has("error-password"))
<x-toast-error>
    {{ session()->get("error-password") }}
</x-toast-error>
@endif

@if (session()->has("error-delete"))
<x-toast-error>
    {{ session()->get("error-delete") }}
</x-toast-error>
@endif

@if (session()->has("success-avatar"))
<x-toast-success>
    {{ session()->get("success-avatar") }}
</x-toast-success>
@endif

@if (session()->has("error-avatar"))
<x-toast-error>
    {{ session()->get("error-avatar") }}
</x-toast-error>
@endif

@if (session()->has("success-info"))
<x-toast-success>
    {{ session()->get("success-info") }}
</x-toast-success>
@endif

@if (session()->has("error-info"))
<x-toast-error>
    {{ session()->get("error-info") }}
</x-toast-error>
@endif

<!-- View => From ProfileController → profile() -->
<div class="flex justify-center items-center lg:shadow-md sm:rounded-2xl lg:border-2 lg:border-gray-300 mt-8">
    <div class="flex flex-col w-full">
        <div class="mt-8 mb-1">
            <x-heading class="text-center">Profile Page</x-heading>
        </div>

        <div class="py-12">
            <div class="sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg mx-4 sm:mx-0">
                    <div>
                        <!-- View => From ProfileController → profile() => $user -->
                        @include("profile.partials.change-user-info", ["user" => $user])
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow rounded-lg mx-4 sm:mx-0">
                    <div>
                        @include("profile.partials.change-password")
                    </div>
                </div>

                <div class="p-4 sm:p-8 shadow rounded-lg bg-error-50 mx-4 sm:mx-0">
                    <div>
                        @include("profile.partials.delete-user")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection