<x-app-layout>
    @slot('title', 'Organizer')
    <x-slot name="header">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-items-center tw-gap-2">
                <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
                    Events {{ $organizer->name }}
                </h2>
                <div class="tw-flex tw-items-center tw-gap-1 tw-font-semibold tw-text-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-star-fill tw-w-5 tw-text-yellow-400" viewBox="0 0 16 16">
                        <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    {{ number_format($organizer->organizers_average_ratings, 1) }}
                </div>
            </div>
            <div>
                <span class="tw-text-xs">{{ $organizer->userDetail->address }}</span>
            </div>
        </div>
    </x-slot>

    <x-container>
        <div class="tw-grid tw-w-full lg:tw-grid-cols-3 tw-gap-3">
            @forelse ( $organizer->events as $event )
            <x-card class="tw-flex tw-flex-col">
                <div>
                    <div class="w-full border-b tw-py-2 tw-mb-4">
                        <h3 class="tw-mt-0.5 tw-text-tertiary1 tw-font-bold">{{ $event->title }}</h3>
                    </div>
                    @if (isset($event->banner))
                    <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}"
                        class="tw-h-32 tw-w-full tw-object-cover rounded" />
                    @else
                    <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}"
                        class="tw-h-32 tw-w-full tw-object-cover rounded" />
                    @endif

                </div>
                <div class="tw-flex-grow">
                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <div class="tw-flex tw-text-sm tw-gap-2 tw-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-calendar-week" viewBox="0 0 16 16">
                                <path
                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                            <p>{{ $event->EventStart }} - {{ $event->EventEnd }}</p>
                        </div>

                        <div class="tw-flex tw-gap-2 tw-items-center">
                            <div class="tw-h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-geo-alt-fill tw-h-full" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                </svg>
                            </div>
                            <p class="tw-text-xs">{{ $event->detail_location }}</p>
                        </div>

                        <p class="tw-line-clamp-3 tw-text-sm/relaxed tw-text-gray-500">
                            {{ $event->description }}
                        </p>
                    </div>
                </div>
                <div class="tw-flex tw-flex-col tw-gap-2 tw-justify-end">
                    <div class="tw-flex tw-flex-wrap tw-gap-2">
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
                        <div
                            class="tw-rounded-lg tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-text-gray-800 tw-bg-gray-200">
                            {{ $category->category }}
                        </div>
                        @endforeach
                    </div>
                    <div class="tw-flex tw-flex-wrap tw-gap-2">
                        @foreach ( $event->skills as $skill)
                        <div
                            class="tw-rounded-lg tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-text-gray-800 tw-bg-gray-200">
                            {{ $skill->skill }}
                        </div>
                        @endforeach
                    </div>
                    <a href={{ route('events.show', $event) }} class="tw-group tw-inline-flex tw-items-center justify-between tw-text-sm tw-font-medium
                        tw-text-blue-600 tw-py-4">
                        <div class="tw-inline-flex tw-gap-1">
                            View Event
                            <span aria-hidden="true"
                                class="tw-block tw-transition-all group-hover:tw-ms-1 group-hover:tw-rotate-180">
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
            </x-card>
            @empty
            <x-card>
                <h1>{{ $organizer->name }} haven't events</h1>
            </x-card>
            @endforelse
        </div>

    </x-container>
</x-app-layout>