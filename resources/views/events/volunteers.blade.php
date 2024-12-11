<x-app-layout>
    @slot('title', 'volunteers')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Volunteers Event') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-card.header>
                <x-card.title>My List Volunteers Event</x-card.title>
                <x-card.description>
                    <p class="sm:flex-auto mt-2 text-sm text-gray-700">
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
                                    <x-table.td>{{ \Carbon\Carbon::parse($event->created_at)->format('Y-m-d') }}</x-table.td>
                                    <x-table.td>
                                        <div x-data="{ isOpen: false }">
                                            @php
                                                $userRating = $all_users_rating->get($volunteer->id);
                                            @endphp
                                            <button 
                                                class="px-4 py-2 bg-blue-600 text-white rounded" 
                                                x-on:click="isOpen = true"
                                                onclick="clearSession()"
                                                id="review-button"
                                            >
                                                {{ $userRating->user_rating != null ? 'Edit Review Volunteer' : 'Review Volunteer' }}
                                            </button>

                                            <div 
                                                x-show="isOpen" 
                                                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50"
                                                x-cloak
                                            >
                                                <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
                                                    <h3 class="text-lg font-bold mb-4">
                                                        {{ $userRating->user_rating != null ? 'Edit Review Volunteer' : 'Review Volunteer' }}
                                                    </h3>
                                                    <form action="{{ route('volunteer.review.update', ['event' => $event->id, 'volunteer' => $volunteer->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-4">
                                                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                                            <div class="flex space-x-1">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                <button 
                                                                    type="button"
                                                                    class="{{ $userRating && $i <= $userRating->user_rating ? 'text-yellow-500' : 'text-gray-300' }} hover:text-yellow-500 text-2xl"
                                                                    id="star-{{ $volunteer->id }}-{{ $i }}"
                                                                >
                                                                    &#9733;
                                                                </button>
                                                                @endfor
                                                            </div>
                                                            <input 
                                                                type="hidden" 
                                                                id="rating-input-{{ $volunteer->id }}" 
                                                                name="rating" 
                                                                value="{{ $userRating->user_rating != null ? $userRating->user_rating : '' }}"
                                                            >
                                                        </div>
                                                        
                                                        <div class="flex justify-end space-x-4">
                                                            <button 
                                                                type="button" 
                                                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded"
                                                                x-on:click="isOpen = false"
                                                            >
                                                                Cancel
                                                            </button>
                                                            <button 
                                                                type="submit" 
                                                                class="px-4 py-2 bg-blue-600 text-white rounded"
                                                            >
                                                                {{ $userRating->user_rating != null ? 'Update' : 'Submit' }}
                                                            </button>
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
                        s.classList.toggle('text-yellow-500', i <= index);
                        s.classList.toggle('text-gray-300', i > index);
                    });
                    document.getElementById('rating-input-{{ $volunteer->id }}').value = index + 1;
                    console.log("Volunteer {{ $volunteer->id }} Selected rating: ", index + 1);
                });
            });
        @endforeach
    });
</script>
