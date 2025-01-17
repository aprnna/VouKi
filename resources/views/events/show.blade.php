<x-app-layout>
    @slot('title', 'Detail Event')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <x-container>
        <x-card class="flex justify-center flex-col">
            <img src="{{ route('private.file', basename($event->banner)) }}" alt="{{ $event->title }}"
                class="rounded-sm h-72 min-w-full object-cover" />

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
                        <div id="map" style="height: 50vh; width:50vw; margin-top: 0"></div>
                    </div>
                </div>
                <div class="flex-auto w-1/4">
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
                            <x-primary-button class="bg-red-600">
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
            {{-- <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
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
            </div>  --}}
            {{--<div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Prefered skill</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    {{ $event->prefered_skills }}
            </div>
            <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-medium text-gray-900">Prefered skill</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    {{ $event->category }}
            </div>   --}}
            {{--
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
            </div> --}}
            {{-- <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Rating Organizer</dt>
                        <dd class="text-gray-700 sm:col-span-2 flex items-center">
                            @php $averageRatingOrganizer = round($averageRating); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $averageRatingOrganizer)
                                    <span class="text-2xl text-yellow-500 }}">&#9733;</span>
                                @else
                                    <span class="text-2xl text-gray-300 }}">&#9733;</span>
                                @endif
                            @endfor
                            <p class="ml-2">{{ number_format($averageRating, 1) }} / 5</p>
                        </dd>
                    </div> --}}
        </x-card>
        {{-- 
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
            @if ($event->reviews->isNotEmpty())
                <div class="divide-y divide-gray-200">
                    @foreach ($event->reviews->where('type', 'event') as $review)
                        <div class="py-3 flex justify-between">
                            <div class="flex flex-col">
                                <p class="font-medium text-gray-800">{{ $review->user->name }}</p>
                                <p class="mt-1 text-gray-700">{{ $review->comment }}</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="flex space-x-1 mt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="text-2xl {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                                    @endfor
                                </div>
                                <span class="text-gray-500 text-sm">{{ $review->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No reviews yet. Be the first to leave one!</p>
            @endif


        </x-card>
        @if ($event->volunteers->contains(Auth::id()) &&
    !$event->reviews->where('type', \App\Models\Review::TYPE_EVENT)->pluck('user_id')->contains(Auth::id()) &&
    now()->greaterThan(\Carbon\Carbon::parse($event->EventEnd)))
            <x-card>
                <form action="{{ route('events.review.store', $event) }}" method="POST" class="">
                    @csrf
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-lg text-gray-900">Your Review</h3>
                        <textarea name="comment" rows="3" placeholder="Write your review..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2"></textarea>
                        <label for="" class="mt-4">Your Rating</label>
                        {{-- <select name="rating" id="" class="rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected disabled>select rating</option>
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="1">5</option>
                            </select> --}}
        {{-- <input type="hidden" id="rating-input" name="rating">
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
                        Submit Review
                    </x-primary-button>
                </form>
            </x-card>
        @endif --}}
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
        {{-- <script>
            const stars = document.querySelectorAll('button[id^="star"]');
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
        </script> --}}
    </x-slot>
</x-app-layout>
