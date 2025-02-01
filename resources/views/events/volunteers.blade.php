<x-app-layout>
    @slot('title', 'volunteers')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('My Volunteers Event') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-card.header>
                <x-card.title>My List Volunteers Event</x-card.title>
                <x-card.description>
                    <p class="tw-sm:tw-flex-auto tw-mt-2 tw-text-sm tw-text-gray-700">
                        A list of all the users in your account including their name, title, email and role.
                    </p>
                </x-card.description>
                <x-card.content>
                    <x-table>
                        <x-table.thead>
                            <tr>
                                <x-table.th>Name</x-table.th>
                                <x-table.th>Email</x-table.th>
                                <x-table.th>Date Register</x-table.th>
                                <x-table.th>Action</x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tbody>
                            {{-- @dump($all_users_rating) --}}

                            @foreach ($volunteers as $volunteer)
                            <tr>
                                <x-table.td>{{ $volunteer->name }}</x-table.td>
                                <x-table.td>{{ $volunteer->email }}</x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($event->created_at)->format('Y-m-d') }}
                                </x-table.td>
                                <x-table.td>
                                    <div x-data="{ isOpen: false }">
                                        @php
                                        $userRating = $all_users_rating->get($volunteer->id);
                                        @endphp
                                        <x-primary-button type="button"
                                            x-on:click="isOpen = true" onclick="clearSession()" id="review-button">
                                            {{ $userRating->user_rating != null ? 'Edit Review Volunteer' : 'Review
                                            Volunteer' }}
                                        </x-primary-button>

                                        <div x-show="isOpen"
                                            class="tw-fixed tw-inset-0 tw-bg-gray-900 tw-bg-opacity-50 tw-flex tw-justify-center tw-items-center tw-z-50"
                                            x-cloak>
                                            <div class="tw-bg-white tw-w-1/3 tw-rounded-lg tw-shadow-lg tw-p-6">
                                                <h3 class="tw-text-lg tw-font-bold tw-mb-4">
                                                    {{ $userRating->user_rating != null ? 'Edit Review Volunteer' :
                                                    'Review Volunteer' }}
                                                </h3>
                                                <form
                                                    action="{{ route('volunteer.review.update', ['event' => $event->id, 'volunteer' => $volunteer->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="tw-mb-4">
                                                        <label for="rating"
                                                            class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Rating</label>
                                                        <div class="tw-flex tw-space-x-1">
                                                            @for ($i = 1; $i <= 5; $i++) <button type="button"
                                                                class="{{ $userRating && $i <= $userRating->user_rating ? 'tw-text-yellow-500' : 'tw-text-gray-300' }} hover:tw-text-yellow-500 tw-text-2xl"
                                                                id="star-{{ $volunteer->id }}-{{ $i }}">
                                                                &#9733;
                                                                </button>
                                                                @endfor
                                                        </div>
                                                        <input type="hidden" id="rating-input-{{ $volunteer->id }}"
                                                            name="rating"
                                                            value="{{ $userRating->user_rating != null ? $userRating->user_rating : '' }}">
                                                    </div>

                                                    <div class="tw-flex tw-justify-end tw-space-x-4">
                                                        <x-secondary-button type="button"
                                                            class="tw-px-4 tw-py-2 tw-bg-gray-300 tw-text-gray-800 tw-rounded"
                                                            x-on:click="isOpen = false">
                                                            Cancel
                                                        </x-secondary-button>
                                                        <x-primary-button type="submit">
                                                            {{ $userRating->user_rating != null ? 'Update' : 'Submit' }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </x-table.td>
                            </tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                </x-card.content>
            </x-card.header>
        </x-card>
    </x-container>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @foreach ($volunteers as $volunteer)
            const stars_{{ $volunteer->id }} = document.querySelectorAll('#star-{{ $volunteer->id }}-1, #star-{{ $volunteer->id }}-2, #star-{{ $volunteer->id }}-3, #star-{{ $volunteer->id }}-4, #star-{{ $volunteer->id }}-5');
            stars_{{ $volunteer->id }}.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars_{{ $volunteer->id }}.forEach((s, i) => {
                        s.classList.toggle('tw-text-yellow-500', i <= index);
                        s.classList.toggle('tw-text-gray-300', i > index);
                    });
                    document.getElementById('rating-input-{{ $volunteer->id }}').value = index + 1;
                    console.log("Volunteer {{ $volunteer->id }} Selected rating: ", index + 1);
                });
            });
        @endforeach
    });
</script>
