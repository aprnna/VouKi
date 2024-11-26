<x-app-layout>
    @slot('title', 'Events')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="flex gap-5 flex-wrap  justify-center">
            @foreach ($events as $event)
                <div
                    class="w-full bg-white sm:w-1/2 md:w-1/3 lg:w-1/4 flex flex-col overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <img alt='{{ $event->name }}' src='{{ \Illuminate\Support\Facades\Storage::url($event->banner) }}'
                        class="h-32 w-full object-cover" />

                    <div class="p-4 sm:p-6 flex-grow">
                        <time datetime="2022-10-10" class="block text-xs text-gray-500"> 10th Oct 2022 </time>

                        <a href="#">
                            <h3 class="mt-0.5 text-lg text-gray-900">{{ $event->title }}</h3>
                        </a>

                        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                            {{ $event->description }}
                        </p>

                    </div>
                    <a href={{ Route('events.show', $event) }}
                        class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-blue-600 p-4">
                        Detail Event

                        <span aria-hidden="true" class="block transition-all group-hover:ms-0.5 rtl:rotate-180">
                            &rarr;
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </x-container>
</x-app-layout>
