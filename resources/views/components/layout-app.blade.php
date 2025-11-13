@props(['width' => 'max-w-3xl'])

<div class="h-screen">
    <div class="flex flex-col items-center justify-center">
        <div class="w-full space-y-6">
            @include("include.navbar")

            <!-- Main content -->
            <div class="flex justify-center w-full px-4 sm:px-6 lg:px-8 mt-8 sm:mt-12">
                <div class="w-full {{ $width }} font-sans mx-auto mb-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>