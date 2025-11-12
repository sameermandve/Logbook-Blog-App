<section>
    <header>
        <h2 class="font-heading font-medium text-lg text-gray-900">
            Profile Information
        </h2>

        <p class="text-sm text-gray-600 mt-1">
            Update your account details, including username, bio, email address, and profile avatar.
        </p>

        @if (session()->has("success-avatar"))
        <x-alert class="text-success-800 bg-success-50 mt-4">
            {{ session()->get("success-avatar") }}
        </x-alert>
        @endif

        @if (session()->has("error-avatar"))
        <x-alert class="text-error-800 bg-error-50 mt-4">
            {{ session()->get("error-avatar") }}
        </x-alert>
        @endif

        @if (session()->has("success-info"))
        <x-alert class="text-success-800 bg-success-50 mt-4">
            {{ session()->get("success-info") }}
        </x-alert>
        @endif

        @if (session()->has("error-info"))
        <x-alert class="text-error-800 bg-error-50 mt-4">
            {{ session()->get("error-info") }}
        </x-alert>
        @endif
    </header>

    <form action="{{ route("profile.update") }}" method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="flex flex-col items-center justify-center">
            <img class="size-25 rounded-full border-2 mb-1" src="{{ $user->avatar ?? 'https://res.cloudinary.com/dhh432tdg/image/upload/v1758554584/avatar_pco8fs.png' }}" alt="Rounded avatar">
            <a href="{{ route('profile.avatar.delete') }}">
                <x-lucide-trash-2 class="size-6 text-error-600 hover:text-error-700 cursor-pointer hover:scale-105" />
            </a>
        </div>

        <div>
            <x-input-label for="avatar">Upload Image</x-input-label>
            <x-file-input name="avatar" id="avatar" />
        </div>

        <div>
            <x-input-label for="username">Username</x-input-label>
            <x-text-input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                class="block mt-2 w-full" />
            @error("username")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="username">Email</x-input-label>
            <x-text-input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="block mt-2 w-full" />
            @error("email")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <div>
            <x-input-label for="bio">Bio</x-input-label>
            <x-textarea name="bio" id="bio"
                class="block mt-2 w-full">{{ old('bio', $user->bio) }}</x-textarea>
            @error("bio")
            <x-input-error>{{ $message }}</x-input-error>
            @enderror
        </div>

        <x-primary-button>Save</x-primary-button>
    </form>
</section>