<section>
    <header>
        <h2 class="font-heading font-medium text-lg text-gray-900">
            Change Password
        </h2>

        <p class="text-sm text-gray-600 mt-1">
            Ensure your account is using a long, random password to stay secure.
        </p>

        @if (session()->has("error-password"))
            <x-alert class="text-error-800 bg-error-50 mt-4">
                {{ session()->get("error-password") }}
            </x-alert>
        @endif
    </header>

    <form action="{{ route("password.change") }}" method="post" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <x-input-label for="old_password">Old Password</x-input-label>
            <x-text-input type="password" name="old_password" id="old_password" placeholder="********"
                class="block mt-2 w-full" />
            @error("old_password")
                <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="new_password">New Password</x-input-label>
            <x-text-input type="password" name="new_password" id="new_password" placeholder="********"
                class="block mt-2 w-full" />
            @error("new_password")
                <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="new_password_confirmation">Confirm Password</x-input-label>
            <x-text-input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="********"
                class="block mt-2 w-full" />
        </div>

        <x-primary-button>Change Password</x-primary-button>
    </form>
</section>