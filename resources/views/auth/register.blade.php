@extends("layouts.auth")

@section("title", "Logbook | Register")

@section("main")
<div x-data="formLoading" class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <x-heading>Register to Logbook</x-heading>

    @if (session()->has("error"))
    <x-alert class="text-red-800 bg-red-50">{{ session()->get("error") }}</x-alert>
    @endif

    <form action="{{ route("register.post") }}" method="post" class="space-y-4 md:space-y-6" @submit="start" autocomplete="off" novalidate>
        @csrf

        <div>
            <x-input-label for="username">Username</x-input-label>
            <x-text-input type="text" id="username" name="username" placeholder="johndoe" value="{{ old('username') }}"
                class="block mt-2 w-full" />
            @error("username")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="email">Email</x-input-label>
            <x-text-input type="email" id="email" name="email" placeholder="email@example.com"
                value="{{ old('email') }}" class="block mt-2 w-full" />
            @error("email")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="password">Password</x-input-label>
            <x-text-input type="password" id="password" name="password" placeholder="********"
                class="block mt-2 w-full" />
            @error("password")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="password_confirmation">Confirm Password</x-input-label>
            <x-text-input type="password" id="password_confirmation" name="password_confirmation" placeholder="********"
                class="block mt-2 w-full" />
        </div>

        <x-primary-button x-bind:disabled="loading" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
            <span x-show="!loading">Register</span>
            <div x-show="loading" class="flex items-center justify-center">
                <x-lucide-loader-circle class="size-6 animate-spin" />
            </div>
        </x-primary-button>

        <p class="text-sm font-light text-gray-500">
            Already have an account?
            <a href="{{ route("login") }}" class="font-medium font-heading text-primary-600 hover:underline">Login</a>
        </p>
    </form>
</div>
@endsection