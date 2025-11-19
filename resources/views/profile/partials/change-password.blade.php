<section x-data="formLoading">
    <header>
        <h2 class="font-heading font-medium text-lg text-gray-900">
            Change Password
        </h2>

        <p class="text-sm text-gray-600 mt-1">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <!-- View => From ProfileController → profile() -->
    <!-- Action => From ProfileController → changeUserPassword() -->
    <form action="{{ route("password.change") }}" method="post" class="mt-6 space-y-6" @submit="start" autocomplete="off">
        @csrf
        @method('PATCH')
        <div>
            <x-input-label for="old_password">Old Password</x-input-label>
            <x-text-input type="password" name="old_password" id="old_password" placeholder="********"
                class="block mt-2 w-full" autocomplete="new-password" />
            @error("old_password")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="new_password">New Password</x-input-label>
            <x-text-input type="password" name="new_password" id="new_password" placeholder="********"
                class="block mt-2 w-full" autocomplete="new-password" />
            @error("new_password")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="new_password_confirmation">Confirm Password</x-input-label>
            <x-text-input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="********"
                class="block mt-2 w-full" autocomplete="new-password" />
        </div>

        <!-- <x-primary-button>Change Password</x-primary-button> -->
        <x-primary-button x-bind:disabled="loading" x-bind:class="loading ? 'cursor-not-allowed' : 'cursor-default'">
            <span x-show="!loading">Change Password</span>
            <div x-show="loading" class="flex items-center justify-center">
                <x-lucide-loader-circle class="size-6 animate-spin" />
            </div>
        </x-primary-button>
    </form>
</section>