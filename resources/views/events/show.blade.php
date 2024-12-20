<x-app-layout>
    @slot('title', 'Detail Event')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <x-container>
        <x-card class="flex justify-center items-center flex-col">
            <img src="{{ route('private.file', basename($event->banner)) }}" alt="{{ $event->title }}"
                class="rounded-lg h-64 w-2/3 object-cover" />
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
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4 items-center">
                        <dt class="font-medium text-gray-900">Prefered Skill</dt>
                        <div class="flex gap-2">
                            @foreach ($event->skills as $skill)
                                <dd class="text-gray-100 sm:col-span-2 bg-slate-500 px-3 py-2 rounded-lg hover:bg-slate-700">
                                    {{$skill->skill}}
                            @endforeach
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Category Event</dt>
                        <div class="flex gap-2">
                            @foreach ($event->categories as $category)
                                <dd class="text-gray-700 sm:col-span-2 bg-slate-300 px-3 py-2 rounded-lg hover:bg-slate-200">
                                    {{$category->category}}
                            @endforeach
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Description</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $event->description }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Organizer Name</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            {{ $event->organizer->name }}
                        </dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Rating Organizer</dt>
                        <dd class="text-gray-700 sm:col-span-2 flex items-center">
                            @php $averageRatingOrganizer = round($event->organizer_average_rating); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $averageRatingOrganizer)
                                    <span class="text-2xl text-yellow-500 }}">&#9733;</span>
                                @else
                                    <span class="text-2xl text-gray-300 }}">&#9733;</span>
                                @endif
                            @endfor
                            <p class="ml-2">{{ number_format($event->organizer_average_rating, 1) }} / 5</p>
                        </dd>
                    </div>
                </dl>
            </div>
            <h1 class="font-bold">Location Event:</h1>
            <div id="map" style="height: 50vh; width:50vw; margin-top: 0"></div>
            <div class="flex gap-3">
                @if (!$event->volunteers->contains(Auth::id()) && !Auth::user()->can('OrganizeEvent', $event))
                    <form action="{{ route('events.join', $event) }}" method="POST">
                        @csrf
                        <x-primary-button>
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
                        <x-primary-button>
                            List Volunteers
                        </x-primary-button>
                    </a>
                @endcan
            </div>
        </x-card>

        @dump($event->skills)

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
                        s.classList.toggle('text-yellow-500', i <= index);
                        s.classList.toggle('text-gray-300', i > index);
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
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-500');
                    } else {
                        star.classList.remove('text-yellow-500');
                        star.classList.add('text-gray-300');
                    }
                }
            }

            if (currentRating) {
                setRating(currentRating);
            }
        </script>
    </x-slot>
</x-app-layout>
