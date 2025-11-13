<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title", "Logbook | Home")</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-layout-app width="max-w-5xl">
        @yield("content")
    </x-layout-app>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>