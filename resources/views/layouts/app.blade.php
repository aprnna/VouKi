<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    <title>{{ $title ? $title . '/' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    {{-- Leaflet Get My Location --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78/dist/L.Control.Locate.min.css" />

    {{-- Leaflet GeoSearch --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@latest/dist/geosearch.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bladewind --}}
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
</head>

<body class="tw-font-sans tw-antialiased tw-relative">
    <div class="tw-min-h-screen tw-bg-pink-50">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @isset($header)
        <header class="tw-bg-white tw-shadow tw-mb-12">
            <div class="tw-max-w-7xl tw-mx-auto tw-py-6 tw-px-4 sm:tw-px-6 lg:tw-px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="tw-z-0">
            {{ $slot }}
        </main>
    </div>
</body>

{{-- Leaflet --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

{{-- Leaflet Get My Location --}}
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78/dist/L.Control.Locate.min.js" charset="utf-8">
</script>

{{-- Leaflet GeoSearch --}}
<script src="https://unpkg.com/leaflet-geosearch@latest/dist/bundle.min.js"></script>
<script>
    const lat = document.getElementById('latitudeUser');
    const long = document.getElementById('longitudeUser');

    document.addEventListener('DOMContentLoaded', function() {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            lat.value = latitude;
            long.value = longitude;
        }, function(error) {
            console.error('Error getting location:', error);
        });
    });
</script>

@isset($scripts)
{{ $scripts }}
@endisset

</html>