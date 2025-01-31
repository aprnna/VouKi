<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bladewind --}}
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="tw-min-h-screen tw-flex">
        <!-- Left side with pink image -->
        <div class="tw-w-1/2 tw-bg-red-300 tw-flex tw-items-center tw-justify-center">
            <img src="{{ asset('images/vokiWallpaper.jpg') }}" alt="Pink Image" class="tw-object-cover tw-h-full tw-w-full tw-p-24">
        </div>
        <!-- Right side with login form -->
        <div class="tw-w-1/2 tw-flex tw-items-center tw-justify-center tw-bg-white">
            <div class="tw-w-full sm:tw-max-w-md tw-px-6 tw-py-4 tw-bg-rose-100 tw-shadow-md tw-overflow-hidden sm:tw-rounded-lg tw-opacity-0 tw-transition-opacity tw-duration-500 tw-ease-in-out" id="fade-in-content">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fade-in-content').classList.add('tw-opacity-100');
        });
    </script>
</body>

</html>