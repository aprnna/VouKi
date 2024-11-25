<x-app-layout>
    @slot('title', 'Detail Event')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <x-container>
        <x-card class="flex justify-center items-center flex-col">
            <img alt='{{ $event->title }}' src='{{ \Illuminate\Support\Facades\Storage::url($event->banner) }}'
                class="rounded-lg w-2/3 object-cover" />
            <div class="flow-root w-2/3">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Title</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $event->title }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Need Voulenter</dt>
                        <dd class="text-gray-700 sm:col-span-2">{{ $event->max_volunteers }}</dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Registration</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-m-d') }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Date</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ \Carbon\Carbon::parse($event->EventStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->EventEnd)->format('Y-m-d') }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Prefered skill</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $event->prefered_skills }}
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Prefered skill</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $event->category }}
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Description</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $event->description }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div>
                @if (!$event->volunteers->contains(Auth::id()))
                    <form action="{{ route('event.join', $event) }}" method="POST">
                        @csrf
                        <x-primary-button>
                            Join Event
                        </x-primary-button>
                    </form>
                @else
                    <p class="text-green-500">You have already joined this event.</p>
                @endif
            </div>
        </x-card>
    </x-container>
</x-app-layout>
