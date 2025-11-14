@extends("layouts.auth")

@section("title", "Logbook | Login")

@section("main")
<div x-data="formLoading" class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <x-heading>Login to your account</x-heading>

    @if (session()->has("success"))
    <x-alert class="text-success-800 bg-success-50">{{ session()->get("success") }}</x-alert>
    @endif

    @if (session()->has("error"))
    <x-alert class="text-error-800 bg-error-50">{{ session()->get("error") }}</x-alert>
    @endif

    <form action="{{ route("login.post") }}" method="post" class="space-y-4 md:space-y-6" @submit="start" novalidate>
        @csrf

        <div>
            <x-input-label for="email">Email</x-input-label>
            <x-text-input type="email" id="email" name="email" placeholder="email@example.com" value="{{ old('email') }}" class="block mt-2 w-full" />
            @error("email")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="password">Password</x-input-label>
            <x-text-input type="password" id="password" name="password" placeholder="********" class="block mt-2 w-full" autocomplete="new-password" />
            @error("password")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <x-primary-button x-bind:disabled="loading" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
            <span x-show="!loading">Login</span>
            <div x-show="loading" class="flex items-center justify-center">
                <x-lucide-loader-circle class="size-6 animate-spin" />
            </div>
        </x-primary-button>

        <p class="text-sm font-light text-gray-500">
            Not registered yet?
            <a href="{{ route("register") }}" class="font-medium font-heading text-primary-600 hover:underline">Register</a>
        </p>
    </form>
</div>
@endsection