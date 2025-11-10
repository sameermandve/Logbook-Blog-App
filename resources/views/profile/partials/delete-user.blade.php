<section>
    <header>
        <h2 class="font-heading font-medium text-lg text-error-700">
            Delete Account
        </h2>

        <p class="text-sm text-error-500 mt-1">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>

        @if (session()->has("error"))
            <x-alert class=" text-error-800 bg-error-50 mt-4">
                {{ session()->get("error") }}
            </x-alert>
        @endif
    </header>

    <form action="{{ route("profile.delete") }}" method="post" class="mt-6 space-y-6">
        @csrf
        @method('DELETE')
        <div>
            <x-input-label for="password">Password</x-input-label>
            <x-text-input type="password" name="password" id="password" placeholder="********"
                class="block mt-2 w-full" />
            @error("password")
                <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="password_confirmation">Confirm Password</x-input-label>
            <x-text-input type="password" name="password_confirmation" id="password_confirmation" placeholder="********"
                class="block mt-2 w-full" />
        </div>

        <x-danger-button>Delete Account</x-danger-button>
    </form>
</section>