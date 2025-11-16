<section x-data="formLoading">
    <header>
        <h2 class="font-heading font-medium text-lg text-error-700">
            Delete Account
        </h2>

        <p class="text-sm text-error-500 mt-1">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>

        @if (session()->has("error-delete"))
        <x-alert class=" text-error-800 bg-error-50 mt-4">
            {{ session()->get("error-delete") }}
        </x-alert>
        @endif
    </header>

    <!-- View => From ProfileController → profile() -->
    <!-- Action => From ProfileController → deleteUser() -->
    <form action="{{ route("profile.delete") }}" method="post" class="mt-6 space-y-6" @submit="start" autocomplete="off">
        @csrf
        @method('DELETE')
        <div>
            <p class="sm:text-base font-heading font-medium text-gray-900">Enter correct password to delete the account</p>
        </div>
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

        <!-- <x-danger-button>Delete Account</x-danger-button> -->
        <x-primary-button x-bind:disabled="loading" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
            <span x-show="!loading">Delete Account</span>
            <div x-show="loading" class="flex items-center justify-center">
                <x-lucide-loader-circle class="size-6 animate-spin" />
            </div>
        </x-primary-button>
    </form>
</section>