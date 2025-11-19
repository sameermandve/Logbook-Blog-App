<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('scroll-text.svg') }}">
    <title>@yield("title", "Logbook")</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<!-- Layout for profile.partials, profile.edit-profile.blade.php
    search.blade.php & post.create.blade.php -->

<body>
    <x-layout-app>
        @yield("main")
    </x-layout-app>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>