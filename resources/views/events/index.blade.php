<x-app-layout>
    @slot('title', 'Events')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Events') }}
        </h2>

    </x-slot>

    <x-container>
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
                        <a href="#">
                            <h3 class="tw-mt-0.5 tw-text-lg tw-text-rose-950 tw-font-bold tw-pb-4">{{ $event->title }}</h3>
                        </a>
                        <hr>
                        <time datetime="2022-10-10" class="tw-block tw-text-xs tw-text-gray-500 tw-pt-4 tw-pb-4"> 10th Oct 2022 </time>
                        <p class="tw-mt-2 tw-line-clamp-3 tw-text-sm/relaxed tw-text-gray-500">
                            {{ $event->description }}
                        </p>
                    </div>
                    <a href={{ Route('events.show', $event) }}
                        class="tw-group tw-mt-4 tw-inline-flex tw-items-center tw-gap-1 tw-text-sm tw-font-medium tw-text-blue-600 tw-p-4">
                        Detail Event
                        <span aria-hidden="true" class="tw-block tw-transition-all tw-group-hover:tw-ms-0.5 rtl:tw-rotate-180">
                            &rarr;
                        </span>
            </div>
            @endforeach
        </div>
    </x-container>
</x-app-layout>
