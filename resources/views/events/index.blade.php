<x-app-layout>
    @slot('title', 'Events')
    @if (request()->is('/') || request()->is('events'))
        <img src="{{ asset('images/header.png') }}" alt="header.png" class="tw-mb-3">
    @endif

    <x-container>
        @auth
           @if (auth()->user()->role == 'volunteer')
           {{-- @dump($events) --}}
           <div class="tw-flex tw-justify-center tw-mb-3 tw-gap-3">
            <button
                onclick="window.location='{{ request('filter') === 'recommendation' ? route('events.index') : route('events.index', ['filter' => 'recommendation']) }}'"
                class="tw-py-3 tw-px-6 tw-rounded-full tw-drop-shadow-sm tw-text-sm hover:tw-text-blue-600 tw-bg-white {{ request('filter') === 'recommendation' ? 'tw-bg-blue-500 tw-text-white' : '' }}">
                Recommendation
            </button>
           </div>
           @endif
        @endauth
        <div class="tw-flex tw-gap-5 tw-flex-wrap tw-justify-center">
            @foreach ($events as $event)
            <div
                class="tw-w-full tw-bg-white sm:tw-w-1/2 md:tw-w-1/3 lg:tw-w-1/4 tw-flex tw-flex-col tw-overflow-hidden tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg">
                @if (isset($event->banner))
                    <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}"
                    class="tw-h-32 tw-w-full tw-object-cover" />
                @else
                    <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}"
                        class="tw-h-32 tw-w-full tw-object-cover" />
                @endif

                <div class="tw-p-4 sm:tw-p-6 tw-flex-grow">
                    <time datetime="2022-10-10" class="tw-block tw-text-xs tw-text-gray-500"> 10th Oct 2022 </time>

                    <a href="#">
                        <h3 class="tw-mt-0.5 tw-text-lg tw-text-gray-900">{{ $event->title }}</h3>
                    </a>

                    <p class="tw-mt-2 tw-line-clamp-3 tw-text-sm/relaxed tw-text-gray-500">
                        {{ $event->description }}
                    </p>

                </div>
                <a href={{ Route('events.show', $event) }}
                    class="tw-group tw-mt-4 tw-inline-flex tw-items-center justify-between tw-text-sm tw-font-medium tw-text-blue-600 tw-p-4">
                    <div class="tw-inline-flex tw-gap-1">
                        Detail Event
                        <span aria-hidden="true" class="tw-block tw-transition-all group-hover:tw-ms-1 group-hover:tw-rotate-180">
                            &rarr;
                        </span>
                    </div>
                    @if (isset($event->distance))
                        <p class="tw-text-gray-500">
                            {{ number_format($event->distance, 2, ',', '.') }} km
                        </p>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </x-container>
    <x-slot name="scripts">
        <script>
            const lat = document.getElementById('latitude');
            const long = document.getElementById('longitude');

            document.addEventListener('DOMContentLoaded', function() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    lat.value = latitude;
                    long.value = longitude;
                    console.log('Latitude:', lat.value);
                    console.log('Longitude:', long.value);
                }, function(error) {
                    console.error('Error getting location:', error);
                });
            });
        </script>
    </x-slot>
</x-app-layout>
