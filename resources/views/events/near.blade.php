<x-app-layout>
    @slot('title', 'Events')

    @php
        $currentCategoryId = request()->input('category');
        $currentDistance = request()->input('distance');
        $currentSkillId = request()->input('skill');
    @endphp

    <x-container class="tw-px-2 sm:tw-px-6">
        <div class="tw-opacity-0 tw-translate-y-10 tw-duration-500 tw-ease-in-out tw-delay-150">
        <div class="bg-white tw-w-full tw-flex tw-justify-between tw-items-center tw-shadow tw-p-2 tw-rounded tw-my-8">
            <x-dropdown align="left" width="80">
                <x-slot name="trigger">
                    <div class="tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-funnel-fill tw-h-5" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                        </svg>
                        <button
                            class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-transparent tw-text-sm tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white hover:tw-text-gray-700 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150">
                            <div>Filter</div>

                            <div class="tw-ms-1">
                                <svg class="tw-fill-current tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div class="tw-px-3 flex">
                        <div class="tw-w-full">
                            <h1 class="tw-text-lg tw-font-semibold">By Categories</h1>
                            <a
                                href="{{ route('events.nearest', array_merge(request()->query(), ['category' => null]))}}"
                                class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                        tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                        hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                        {{ $currentCategoryId == null ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                            >
                                <div>All Categories</div>
                            </a>
                            @foreach ( $categories as $category)
                                <a
                                    href="{{ route('events.nearest', array_merge(request()->query(),['category' => $category->id])) }}"
                                    class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                            tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                            hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                            {{ $currentCategoryId == $category->id ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                                >
                                    <div>{{ $category->category }}</div>
                                </a>
                            @endforeach
                        </div>
                        <div class="tw-w-full">
                            <h1 class="tw-text-lg tw-font-semibold">By Distance</h1>
                            <a
                                href="{{ route('events.nearest', array_merge(request()->query(),['distance' => null])) }}"
                                class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                        tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                        hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                        {{ $currentDistance == null ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                            >
                                <div>All Nearest</div>
                            </a>
                            <a
                                href="{{ route('events.nearest', array_merge(request()->query(),['distance' => '10km'])) }}"
                                class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                        tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                        hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                        {{ $currentDistance == '10km' ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                            >
                                <div>10 KM</div>
                            </a>
                            <a
                                href="{{ route('events.nearest', array_merge(request()->query(),['distance' => '100km'])) }}"
                                class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                        tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                        hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                        {{ $currentDistance == '100km' ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                            >
                                <div>100 KM</div>
                            </a>
                            <a
                                href="{{ route('events.nearest', array_merge(request()->query(),['distance' => '1000km'])) }}"
                                class="tw-flex tw-items-center tw-py-2 tw-border tw-border-transparent tw-text-sm
                                        tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white
                                        hover:tw-text-gray-900 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150
                                        {{ $currentDistance == '1000km' ? 'tw-text-gray-900 tw-underline tw-underline-offset-4' : 'tw-text-gray-500' }}"
                            >
                                <div>1000 KM</div>
                            </a>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>

            {{-- Search Bar Section --}}
            <form action="{{ route('events.nearest') }}" method="GET">
                <label for="searchEvents" class="flex tw-h-full tw-items-center tw-border">
                    <input type="hidden" name="latitudeUser" value="{{ $userLatitude }}">
                    <input type="hidden" name="longitudeUser" value="{{ $userLongitude }}">
                    <input type="hidden" name="category" value="{{ $currentCategoryId }}">
                    <input type="text" name="searchEvents" id="searchEvents" class="tw-w-full tw-h-full tw-border-none"/>
                    <button class="tw-bg-tertiary1 tw-h-full tw-text-white tw-p-2 tw-rounded-tr tw-rounded-br">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </label>
            </form>
        </div>

        {{-- Map Section --}}

        <div class="tw-w-full tw-h-96 tw-flex tw-items-center tw-relative tw-justify-center tw-p-5 tw-rounded-lg tw-mb-8">
            <div id="map" style="margin-top: 0" class="tw-rounded-lg tw-absolute tw-w-full tw-h-full z-1"></div>
        </div>

        @if (!$events->isNotEmpty())
            <div>
                <h1>Events Not Found</h1>
            </div>
        @endif

        @auth
           @if (auth()->user()->role == 'volunteer' && request()->is('events'))
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
            <div class="tw-w-full tw-bg-white tw-flex tw-flex-col tw-overflow-hidden tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg tw-opacity-0 tw-translate-y-10 tw-duration-500 tw-ease-in-out tw-delay-150 hover:tw-scale-105">
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
                    @php
                        $currentCategory = request()->query('category');
                        $shouldRemoveSkill = $currentCategory && $currentCategory == $category->id;

                        if ($shouldRemoveSkill) {
                            $categoryQuery = Arr::except(request()->query(), ['category']);
                        } else {
                            $categoryQuery = array_merge(request()->query(), ['category' => $category->id]);
                        }
                    @endphp
                    <a
                         href="{{ route('events.nearest', $categoryQuery) }}"
                        class="tw-rounded-lg tw-px-2 tw-py-1 tw-text-xs tw-font-medium hover:tw-bg-gray-400 hover:tw-cursor-pointer tw-text-gray-800
                        {{ $currentCategoryId == $category->id ? 'tw-bg-gray-400' : 'tw-bg-gray-200' }}"
                    >
                        {{ $category->category }}
                    </a>
                @endforeach
            </div>
            <div class="tw-flex tw-flex-wrap tw-gap-2 tw-px-4 sm:tw-px-6 tw-mt-2">
                @foreach ( $event->skills as $skill)
                    @php
                        $currentSkill = request()->query('skill');
                        $shouldRemoveSkill = $currentSkill && $currentSkill == $skill->id;

                        if ($shouldRemoveSkill) {
                            $queryString = Arr::except(request()->query(), ['skill']);
                        } else {
                            $queryString = array_merge(request()->query(), ['skill' => $skill->id]);
                        }
                    @endphp
                    <a
                        href="{{ route('events.nearest', $queryString) }}"
                        class="tw-rounded-lg tw-px-2 tw-py-1 tw-text-xs tw-font-medium hover:tw-bg-gray-400 hover:tw-cursor-pointer tw-text-gray-800
                        {{ $currentSkillId == $skill->id ? 'tw-bg-gray-400' : 'tw-bg-gray-200' }}"
                    >
                        {{ $skill->skill }}
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
            document.addEventListener('DOMContentLoaded', function() {
                const elements = document.querySelectorAll('.tw-opacity-0');
                elements.forEach((element, index) => {
                    setTimeout(() => {
                        element.classList.remove('tw-opacity-0', 'tw-translate-y-10');
                    }, index * 150);
                });
            });
        </script>
        <script>
            // Inisialisasi peta
            var map = L.map('map').setView([{{ $userLatitude }}, {{ $userLongitude }}], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Marker untuk event
            @foreach ($events as $event)
            var eventMarker = L.marker([{{ $event->latitude }}, {{ $event->longitude }}]).addTo(map)
                .bindPopup(`<strong>{{ $event->title }}</strong>
                            <br>By {{ $event->organizer->name }}<br>
                            <a href={{ Route('events.show', $event) }}>
                                Click to View Event
                            </a>`)
                .openPopup();
            @endforeach

            var lc = L.control
                .locate({
                    position: "topright",
                    strings: {
                        title: "Show me where I am, yo!"
                    },
                    locateOptions: {
                        enableHighAccuracy: true,
                    }
                })
                .addTo(map);

            lc.start();

        </script>
    </x-slot>
</x-app-layout>
