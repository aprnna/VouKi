<x-app-layout>
    @slot('title', 'Events')
    <x-container>
        <div class="tw-flex tw-flex-col tw-w-full tw-gap-2 tw-m-8">
            <h1 class="tw-text-2xl tw-font-semibold">Start searching for available volunteer opportunity right away</h1>
            {{-- <div class="bg-white tw-w-full tw-drop-shadow tw-p-2 tw-rounded"> --}}
                <label for="searchEvents" class="flex tw-w-full tw-h-full tw-items-center tw-border">
                    <input type="text" name="searchEvents" id="searchEvents" class="tw-w-full tw-h-full tw-border-none"/>
                    <button class="tw-bg-tertiary1 tw-h-full tw-text-white tw-p-2 tw-rounded-tr tw-rounded-br">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </label>
            {{-- </div> --}}
        </div>

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
        <div class="tw-grid w-full tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-mb-8 tw-gap-5">
            @foreach ($events as $event)
            <div
                class="tw-w-full tw-bg-white tw-flex tw-flex-col tw-overflow-hidden tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg">
                @if (isset($event->banner))
                    <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}"
                    class="tw-h-32 tw-w-full tw-object-cover" />
                @else
                    <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}"
                        class="tw-h-32 tw-w-full tw-object-cover" />
                @endif

                <div class="w-full border-b tw-py-2 tw-px-4 sm:tw-px-6">
                    <a href={{ Route('events.show', $event) }}>
                        <h3 class="tw-mt-0.5 tw-text-tertiary1 tw-font-bold">{{ $event->title }}</h3>
                    </a>
                    <h1 class="tw-text-sm">{{ $event->organizer->name }}</h1>
                </div>
                <div class="tw-p-4 sm:tw-p-6 tw-flex-grow">
                    <div class="tw-flex tw-flex-col tw-gap-2">

                        <div class="tw-flex tw-text-sm tw-gap-2 tw-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg>
                            <p>{{ $event->EventStart }} - {{ $event->EventEnd }}</p>
                        </div>

                        <div class="tw-flex tw-gap-2 tw-items-center">
                            <div class="tw-h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill tw-h-full" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                  </svg>
                            </div>
                            <p class="tw-text-xs">{{ $event->detail_location }}</p>
                        </div>

                        <p class="tw-line-clamp-3 tw-text-sm/relaxed tw-text-gray-500">
                            {{ $event->description }}
                        </p>
                    </div>
                </div>
                <div class="tw-flex tw-flex-wrap tw-gap-2 tw-px-4 sm:tw-px-6">
                    @foreach ( $event->categories as $category)
                        <a
                            href="{{ route('events.index', ['category' => $category->id]) }}"
                            class="tw-bg-gray-200 tw-rounded-lg tw-px-2 tw-py-1 tw-text-xs tw-font-medium hover:tw-bg-gray-400 hover:tw-cursor-pointer tw-text-gray-800"
                        >
                            {{ $category->category }}
                        </a>
                    @endforeach
                </div>
                <a href={{ Route('events.show', $event) }}
                    class="tw-group tw-inline-flex tw-items-center justify-between tw-text-sm tw-font-medium tw-text-blue-600 tw-py-4 tw-px-4 sm:tw-px-6">
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
