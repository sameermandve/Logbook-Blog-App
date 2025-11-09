@extends("layouts.auth")

@section("title", "Logbook | Login")

@section("main")
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <x-heading>Login to your account</x-heading>

        @if (session()->has("success"))
            <x-alert class="text-green-800 bg-green-50">{{ session()->get("success") }}</x-alert>
        @endif

        @if (session()->has("error"))
            <x-alert class="text-red-800 bg-red-50">{{ session()->get("error") }}</x-alert>
        @endif

        <form action="{{ route("login.post") }}" method="post" class="space-y-4 md:space-y-6" novalidate>
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
                <x-text-input type="password" id="password" name="password" placeholder="********" class="block mt-2 w-full" />
                @error("password")
                <x-input-error>{{ $message }}</x-input-error>
                @enderror
            </div>

            <x-primary-button>Login</x-primary-button>

            <p class="text-sm font-light text-gray-500">
                Not registered yet?
                <a href="{{ route("register") }}" class="font-medium font-heading text-primary-600 hover:underline">Register</a>
            </p>
        </form>
    </div>
@endsection
