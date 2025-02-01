<x-app-layout>
    @slot('title', 'Detail Event')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <x-container>
        <x-alert-status />
        <x-card class="tw-flex tw-flex-col">
            <div class="tw-flex tw-justify-center tw-transition-opacity tw-duration-500 tw-ease-in-out tw-opacity-0" id="banner-container">
                @if (isset($event->banner))
                <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}"
                    class="tw-rounded-lg tw-h-96 tw-w-full tw-object-cover" />
                @else
                <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}"
                    class="tw-rounded-lg tw-h-96 tw-w-full tw-object-cover" />
                @endif
            </div>
            <div class="tw-flex tw-flex-row">
                <div class="tw-flex-auto tw-w-3/4 tw-pr-5">
                    <div class="tw-justify-start">
                        <div class="tw-font-sans tw-font-semibold tw-text-xl tw-text-gray-900">{{ $event->title }}</div>
                    </div>
                    <div class="tw-pt-4 tw-pb-4">
                        <i>by</i> {{ $event->organizer->name }}
                    </div>
                    <div class="tw-pt-4">
                        <p class="tw-text-justify">{{ $event->description }}</p>
                    </div>
                    <div class="tw-pt-4 tw-pb-4">
                        <h1 class="tw-font-bold">Location Event:</h1>
                    </div>
                    <div>
                        <div id="map" style="height: 50vh; width:50vw; margin-top: 0" class="tw-rounded-lg"></div>
                    </div>
                </div>
                <div class="tw-flex-auto tw-w-1/4">
                    @if (!$event->volunteers->contains(Auth::id()) && !Auth::user()->can('OrganizeEvent', $event))
                        <form action="{{ route('events.answer.create', $event) }}" method="POST">
                            @csrf
                            @method('get')
                            <x-primary-button class="tw-flex-auto tw-w-full tw-bg-red-600 tw-justify-center">
                                Join Event
                            </x-primary-button>
                        </form>
                    @elseif (Auth::user()->can('OrganizeEvent', $event))
                        @can('OrganizeEvent', $event)
                        <a href="{{ route('events.volunteers', $event) }}">
                            <x-primary-button class="tw-flex-auto tw-w-full tw-bg-red-600 tw-justify-center hover:tw-bg-red-700">
                                List Volunteers
                            </x-primary-button>
                        </a>
                        @endcan
                    @else
                        <p class="tw-text-green-500">You have already joined this event.</p>
                    @endif
                    <div class="tw-py-4 tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <b>Registration</b>
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-m-d') }}
                    </div>
                    <div class="tw-py-4 tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-7 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <b>Date And Time</b>
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($event->EventStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->EventEnd)->format('Y-m-d') }}
                    </div>
                    <div class="tw-py-4 tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                        <b>Volunteers Needed</b>
                    </div>
                    <div>
                        {{ $event->max_volunteers }}
                    </div>
                    <div class="tw-py-4 tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <b>Preferred Skills</b>
                    </div>
                    <div class="tw-flex tw-flex-wrap tw-gap-2">
                        @foreach ($event->skills as $skill)
                            <dd
                                class="tw-text-gray-100 tw-bg-slate-500 tw-px-3 tw-py-2 tw-rounded-lg tw-hover:bg-slate-700 tw-flex-auto">
                                {{$skill->skill}}
                        @endforeach
                    </div>
                    <div class="tw-py-4 tw-flex tw-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-5 tw-w-5 tw-mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <b>Event Category</b>
                    </div>
                    <div class="tw-flex tw-flex-wrap tw-gap-2">
                        @foreach ($event->categories as $category)
                            <dd
                                class="tw-text-gray-700 tw-bg-slate-300 tw-px-3 tw-py-2 tw-rounded-lg tw-hover:bg-slate-700 tw-flex-auto">
                                {{$category->category}}
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tw-flex-1">
                @if ($event->volunteers->contains(function ($volunteer) {
                    return
                        $volunteer->id === Auth::id() &&
                        $volunteer->user_acceptance_status === 'accepted';
                    }) &&
                    now()->greaterThan(\Carbon\Carbon::parse($event->EventEnd)))
                    <x-card>
                    <form action="{{ route('events.review.update', $event) }}" method="POST" class="">
                        @csrf
                        @method('PATCH')
                        <div class="tw-flex tw-flex-col">
                            <h3 class="tw-font-semibold tw-text-lg tw-text-gray-900">Your Review</h3>
                            @php
                                $comment = "";
                                $rating = null;

                                $review = $event->all_event_reviews->where('user_id', Auth::id())->first();
                                if ($review) {
                                    $comment = $review->user_review;
                                    $rating = $review->event_rating;
                                }
                            @endphp
                            <textarea name="comment" rows="3" placeholder="Write your review..."
                                class="tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 tw-mt-2">{{$comment}}</textarea>
                            <label for="" class="tw-mt-4">Your Rating</label>
                            <input type="hidden" id="rating-input" name="rating" value="{{ $rating }}">
                            <div class="tw-flex tw-space-x-1">
                                <button type="button" class="tw-text-gray-300 hover:tw-text-yellow-500 tw-text-2xl"
                                    id="star1">&#9733;</button>
                                <button type="button" class="tw-text-gray-300 hover:tw-text-yellow-500 tw-text-2xl"
                                    id="star2">&#9733;</button>
                                <button type="button" class="tw-text-gray-300 hover:tw-text-yellow-500 tw-text-2xl"
                                    id="star3">&#9733;</button>
                                <button type="button" class="tw-text-gray-300 hover:tw-text-yellow-500 tw-text-2xl"
                                    id="star4">&#9733;</button>
                                <button type="button" class="tw-text-gray-300 hover:tw-text-yellow-500 tw-text-2xl"
                                    id="star5">&#9733;</button>
                            </div>
                        </div>
                        @if (session('message'))
                            <p class="tw-text-red-500 tw-mt-2">{{ session('message') }}</p>
                        @elseif(session('success'))
                            <p class="tw-text-green-500 tw-mt-2">{{ session('success') }}</p>
                        @endif
                        <x-primary-button class="tw-mt-4">
                            {{ $rating !== null ? 'Edit Review' : 'Submit Review' }}
                        </x-primary-button>
                    </form>
                </x-card>
            @endif

            <x-card class="tw-w-full tw-mt-6">
                <div class="tw-flex tw-justify-between">
                    <h3 class="tw-font-semibold tw-text-lg tw-text-gray-900">Reviews</h3>
                    <div class="rating tw-flex tw-items-center tw-justify-end">
                        @php $averageRatingEvent = round($event->average_rating); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $averageRatingEvent)
                                <span class="tw-text-2xl tw-text-yellow-500 }}">&#9733;</span>
                            @else
                                <span class="tw-text-2xl tw-text-gray-300 }}">&#9733;</span>
                            @endif
                        @endfor
                        <p class="tw-ml-2">{{ number_format($event->average_rating, 1) }} / 5</p>
                    </div>
                </div>
                @if ($event->all_event_reviews->isNotEmpty())
                    <div class="tw-divide-y tw-divide-gray-200">
                        @foreach ($event->all_event_reviews as $review)
                            @if ($review->event_rating != null)
                                <div class="tw-py-3 tw-flex tw-justify-between">
                                    <div class="tw-flex tw-flex-col">
                                        <p class="tw-font-medium tw-text-gray-800">{{ $review->name }}</p>
                                        <p class="tw-mt-1 tw-text-gray-700">{{ $review->user_review }}</p>
                                    </div>
                                    <div class="tw-flex tw-flex-col tw-items-end">
                                        <div class="tw-flex tw-space-x-1 tw-mt-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="tw-text-2xl {{ $i <= $review->event_rating ? 'tw-text-yellow-500' : 'tw-text-gray-300' }}">&#9733;</span>
                                            @endfor
                                        </div>
                                        <span class="tw-text-gray-500 tw-text-sm">{{ $review->created_at->format('Y-m-d') }}</span>
                                    </div>
                            @else
                                <div></div>
                            @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="tw-text-gray-500">No reviews yet. Be the first to leave one!</p>
                @endif
            </x-card>
            </div>
        </x-card>
    </x-container>
    <x-slot name="scripts">
        {{-- Maps --}}
        <script>
            latitude = {{ $event->latitude }};
            longitude = {{ $event->longitude }};
            var map = L.map('map').setView([latitude, longitude], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.marker([latitude, longitude])
                .bindPopup('{{ $event->detail_location }}')
                .addTo(map);
        </script>
        {{-- Review --}}
        <script>
            const stars = document.querySelectorAll('button[id^="star"]');
            let currentRating = document.getElementById('rating-input').value;
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    console.log("Selected rating: ", index + 1);
                    stars.forEach((s, i) => {
                        s.classList.toggle('tw-text-yellow-500', i <= index);
                        s.classList.toggle('tw-text-gray-300', i > index);
                    });
                    document.getElementById('rating-input').value = index + 1;
                });
            });

            function setRating(rating) {
                currentRating = rating;
                document.getElementById('rating-input').value = rating;

                for (let i = 1; i <= 5; i++) {
                    const star = document.getElementById(`star${i}`);
                    if (i <= rating) {
                        star.classList.remove('tw-text-gray-300');
                        star.classList.add('tw-text-yellow-500');
                    } else {
                        star.classList.remove('tw-text-yellow-500');
                        star.classList.add('tw-text-gray-300');
                    }
                }
            }

            if (currentRating) {
                setRating(currentRating);
            }
        </script>
    </x-slot>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bannerContainer = document.getElementById('banner-container');
        bannerContainer.classList.remove('tw-opacity-0');
        bannerContainer.classList.add('tw-opacity-100');
    });
</script>
