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
</head>

<body class="tw-text-tertiary1 tw-antialiased">
    <div class="tw-min-h-screen tw-flex tw-justify-end tw-items-center tw-pt-6 sm:tw-pt-0 tw-bg-white">
        @if (isset($image))
            <div class="tw-hidden lg:tw-flex tw-w-full tw-relative tw-h-screen tw-items-center {{ $imageClass ?? "tw-bg-tertiary1" }}">
                {{ $image }}
            </div>
        @endif
        <div class="tw-min-h-screen tw-w-full tw-flex tw-items-center tw-justify-center tw-relative tw-bg-white tw-z-50">
            <div class="tw-w-full sm:tw-max-w-md tw-mt-6 tw-px-6 tw-py-4 tw-bg-primary1 tw-shadow-md sm:tw-rounded-lg animate__animated animate__fadeIn">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
