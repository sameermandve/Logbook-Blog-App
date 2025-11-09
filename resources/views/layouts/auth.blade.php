<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="h-screen">
        <div class="container mx-auto md:h-full flex flex-col items-center justify-center">
            <div class="w-full max-w-md">
                <div class="flex flex-col items-center justify-center space-y-4 font-sans px-6 py-8">
                    <div>
                        <x-application-logo />
                    </div>
                    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                        @yield("main")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>