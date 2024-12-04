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
            <div class="flex gap-3">
                @if (!$event->volunteers->contains(Auth::id()))
                    <form action="{{ route('events.join', $event) }}" method="POST">
                        @csrf
                        <x-primary-button>
                            Join Event
                        </x-primary-button>
                    </form>
                @else
                    <p class="text-green-500">You have already joined this event.</p>
                @endif
                @can('OrganizeEvent', $event)
                    <a href="{{ route('events.volunteers', $event) }}">
                        <x-primary-button>
                            List Volunteers
                        </x-primary-button>
                    </a>
                @endcan
            </div>
        </x-card>

        <x-card class="w-2/3 mt-6">
            <h3 class="font-semibold text-lg text-gray-900 mb-4">Reviews</h3>

            @if ($event->reviews->isNotEmpty())
                <div class="divide-y divide-gray-200">
                    @foreach ($event->reviews as $review)
                        <div class="py-3">
                            <div class="flex justify-between items-center">
                                <p class="font-medium text-gray-800">{{ $review->user->name }}</p>
                                <span class="text-gray-500 text-sm">{{ $review->created_at->format('Y-m-d') }}</span>
                            </div>
                            <p class="mt-1 text-gray-700">{{ $review->content }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No reviews yet. Be the first to leave one!</p>
            @endif

            @if ($event->volunteers->contains(Auth::id()))
                <form action="{{ route('reviews.store', $event) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" placeholder="Write your review..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    <x-primary-button class="mt-2">
                        Submit Review
                    </x-primary-button>
                </form>
            @endif
        </x-card>
    </x-container>
</x-app-layout>
