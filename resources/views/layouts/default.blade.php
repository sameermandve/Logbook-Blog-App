<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Logbook | Home")</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="h-screen">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full space-y-6">
                @include("include.navbar")

                <div class="w-full max-w-3xl mx-auto mb-4">
                    <div class="container">
                        @yield("main")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>