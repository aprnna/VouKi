<x-app-layout>
    @slot('title', 'Detail Event')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <x-container>
        <x-card class="flex justify-center flex-col">
            <img src="{{ route('private.file', basename($event->banner)) }}" alt="{{ $event->title }}"
                class="rounded-md h-72 min-w-full object-cover" />

            <div class="flex flex-row">
                <div class="flex-auto w-3/4 pr-5">
                    <div class="justify-start">
                        <div class="font-sans font-semibold text-xl text-gray-900">{{ $event->title }}</div>
                    </div>
                    <div class="pt-4 pb-4">
                        <i>by</i> {{ $event->organizer->name }}
                    </div>
                    <div class="pt-4">
                        <p class="text-justify">{{ $event->description }}</p>
                    </div>
                    <div class="pt-4 pb-4">
                        <h1 class="font-bold">Location Event:</h1>
                    </div>
                    <div>
                        <div id="map" style="height: 50vh; width:50vw; margin-top: 0" class="rounded-lg"></div>
                    </div>
                </div>
                <div class="flex-auto w-1/4">
                    @if (!$event->volunteers->contains(Auth::id()) && !Auth::user()->can('OrganizeEvent', $event))
                        <form action="{{ route('events.join', $event) }}" method="POST">
                            @csrf
                            <x-primary-button class="flex-auto w-full bg-red-600 justify-center">
                                Join Event
                            </x-primary-button>
                        </form>
                    @elseif (Auth::user()->can('OrganizeEvent', $event))
                        <div></div>
                    @else
                        <p class="text-green-500">You have already joined this event.</p>
                    @endif
                    @can('OrganizeEvent', $event)
                        <a href="{{ route('events.volunteers', $event) }}">
                            <x-primary-button class="flex-auto w-full bg-red-600 justify-center">
                                List Volunteers
                            </x-primary-button>
                        </a>
                    @endcan
                    <div class="py-4">
                        <b>Registration</b>
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-m-d') }}
                    </div>
                    <div class="py-4">
                        <b>Date And Time</b>
                    </div>
                    <div>
                        {{ \Carbon\Carbon::parse($event->EventStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->EventEnd)->format('Y-m-d') }}
                    </div>
                    <div class="py-4">
                        <b>Volunteers Needed</b>
                    </div>
                    <div>
                        {{ $event->max_volunteers }}
                    </div>
                    <div class="py-4">
                        <b>Prefered Skills</b>
                    </div>
                    <div>
                        {{ $event->prefered_skill }}
                    </div>
                    <div class="py-4">
                        <b>Event Category</b>
                    </div>
                    <div>
                        {{ $event->category }}
                    </div>
                </div>
            </div>
            <div class="flex-1">
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
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-lg text-gray-900">Your Review</h3>
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
                                class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">{{$comment}}</textarea>
                            <label for="" class="mt-4">Your Rating</label>
                            <input type="hidden" id="rating-input" name="rating" value="{{ $rating }}">
                            <div class="flex space-x-1">
                                <button type="button" class="text-gray-300 hover:text-yellow-500 text-2xl"
                                    id="star1">&#9733;</button>
                                <button type="button" class="text-gray-300 hover:text-yellow-500 text-2xl"
                                    id="star2">&#9733;</button>
                                <button type="button" class="text-gray-300 hover:text-yellow-500 text-2xl"
                                    id="star3">&#9733;</button>
                                <button type="button" class="text-gray-300 hover:text-yellow-500 text-2xl"
                                    id="star4">&#9733;</button>
                                <button type="button" class="text-gray-300 hover:text-yellow-500 text-2xl"
                                    id="star5">&#9733;</button>
                            </div>
                        </div>
                        @if (session('message'))
                            <p class="text-red-500 mt-2">{{ session('message') }}</p>
                        @elseif(session('success'))
                            <p class="text-green-500 mt-2">{{ session('success') }}</p>
                        @endif
                        <x-primary-button class="mt-4">
                            {{ $rating !== null ? 'Edit Review' : 'Submit Review' }}
                        </x-primary-button>
                    </form>
                </x-card>
            @endif
             
            <x-card class="w-full mt-6">
                <div class="flex justify-between">
                    <h3 class="font-semibold text-lg text-gray-900">Reviews</h3>
                    <div class="rating flex items-center justify-end">
                        @php $averageRatingEvent = round($event->average_rating); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $averageRatingEvent)
                                <span class="text-2xl text-yellow-500 }}">&#9733;</span>
                            @else
                                <span class="text-2xl text-gray-300 }}">&#9733;</span>
                            @endif
                        @endfor
                        <p class="ml-2">{{ number_format($event->average_rating, 1) }} / 5</p>
                    </div>
                </div>
                @if ($event->all_event_reviews->isNotEmpty())
                    <div class="divide-y divide-gray-200">
                        @foreach ($event->all_event_reviews as $review)
                            @if ($review->event_rating != null)
                                <div class="py-3 flex justify-between">
                                    <div class="flex flex-col">
                                        <p class="font-medium text-gray-800">{{ $review->name }}</p>
                                        <p class="mt-1 text-gray-700">{{ $review->user_review }}</p>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <div class="flex space-x-1 mt-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="text-2xl {{ $i <= $review->event_rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                                            @endfor
                                        </div>
                                        <span class="text-gray-500 text-sm">{{ $review->created_at->format('Y-m-d') }}</span>
                                    </div>
                            @else
                                <div></div>
                            @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No reviews yet. Be the first to leave one!</p>
                @endif
            </x-card>
            </div>
        </x-card>

        @dump($event->skills)

    </x-container>
    <x-slot name="scripts">
        {{-- Maps --}}
        <script>
            latitude = {{ $event->latitude }};
            longitude = {{ $event->longitude }};
            var map = L.map('map').setView([longitude, latitude], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Pemetaan'
            }).addTo(map);
            L.marker([longitude, latitude])
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