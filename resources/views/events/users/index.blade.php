<x-app-layout>
    @slot('title', 'Organizer')

    @dump($events)

    <x-container>
        <div class="bg-white tw-w-full tw-flex tw-justify-end tw-items-center tw-shadow tw-p-2 tw-rounded tw-my-8">
            <form action="{{ route('organizer.index') }}" method="GET" class="tw-w-full">
                <label for="searchOrganizer" class="flex tw-h-full tw-items-center tw-border rounded">
                    {{-- <input type="hidden" name="category" value="{{ $currentCategoryId }}"> --}}
                    <input type="text" value="{{ request()->input('searchOrganizer') }}" name="searchOrganizer"
                        id="searchOrganizer" class="tw-w-full tw-h-full tw-border-none rounded"
                        placeholder="Search Name Organizer" />
                    <button type="submit"
                        class="tw-bg-tertiary1 tw-h-full tw-text-white tw-p-2 tw-rounded-tr tw-rounded-br">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </label>
            </form>
        </div>

        <div class="tw-grid w-full tw-grid-cols-1 md:tw-grid-cols-2 tw-mb-8 tw-gap-5 tw-mt-8">
            @foreach ($events as $event)
            <a href="{{ route('organizer.show', $event->id) }}"
                class="tw-w-full tw-bg-white tw-flex tw-items-center tw-justify-center tw-cursor-pointer tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg tw-duration-500 tw-ease-in-out hover:tw-scale-105">
                <div class="w-full tw-flex tw-justify-between tw-p-4 tw-gap-2 tw-flex-wrap lg:tw-flex-nowrap">
                    <div class="tw-flex tw-gap-4 tw-items-center">
                        <img src="{{ asset('images/organizer_logo.png') }}" alt="{{ $event->name }}"
                            class="tw-w-16 tw-rounded-full tw-h-16" />
                        <div class="tw-flex tw-flex-col">
                            <h2 class="tw-text-sm tw-font-bold">{{ $event->organizer->name }}</h2>
                            <span class="tw-text-xs">{{ $event->organizer->userDetail->address }}</span>
                        </div>
                    </div>
                    <div class="tw-flex tw-items-center">
                        <div
                            class="tw-flex flex-col tw-h-full tw-justify-center tw-text-sm tw-items-center tw-px-3 tw-border-l-2">
                            <div class="tw-flex tw-items-center tw-gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path
                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg>
                                {{ $event->organizer->event_numbers }}
                            </div>
                            <h1>Events</h1>
                        </div>
                        <div
                            class="tw-flex flex-col tw-h-full tw-justify-center tw-text-sm tw-items-center tw-px-3 tw-border-l-2">
                            <div class="tw-flex tw-items-center tw-gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-person-fill tw-w-4 tw-text-tertiary1" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                                {{ $event->organizer->volunteer_numbers }}
                            </div>
                            <h1>Volunteer</h1>
                        </div>
                        <div
                            class="tw-flex flex-col tw-h-full tw-justify-center tw-border-l-2 tw-text-sm tw-items-center tw-px-3">
                            <div class="tw-flex tw-items-center tw-gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-star-fill tw-w-4 tw-text-yellow-400" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                {{ number_format($event->organizer->organizers_average_ratings, 1) }}
                            </div>
                            <h1>Rating</h1>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </x-container>
</x-app-layout>