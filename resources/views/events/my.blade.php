<x-app-layout>
    @slot('title', 'My Events')

    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <x-container>
        <x-alert-status />
        <x-card>
            <x-card.header>
                <x-card.title>My Event</x-card.title>
                <x-card.description>
                    <div class="tw-sm:flex tw-sm:items-center">
                        <p class="tw-sm:flex-auto tw-mt-2 tw-text-sm tw-text-gray-700">
                            A list of all the users in your account including their name, title, email and role.
                        </p>
                        <div class="tw-mt-4 tw-sm:ml-16 tw-sm:mt-0 tw-sm:flex-none">
                            <a href={{ Route('events.create', ['step'=>1] ) }}>
                                <button type="button"
                                    class="tw-block tw-rounded-md tw-bg-indigo-600 tw-px-3 tw-py-2 tw-text-center tw-text-sm tw-font-semibold tw-text-white tw-shadow-sm hover:tw-bg-indigo-500 focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2 focus-visible:tw-outline-indigo-600">
                                    Create Event
                                </button>
                            </a>
                        </div>
                    </div>
                </x-card.description>
                <x-card.content>
                    <x-table>
                        <x-table.thead>
                            <tr>
                                <x-table.th>Title</x-table.th>
                                <x-table.th>Register Date</x-table.th>
                                <x-table.th>Activity Date</x-table.th>
                                <x-table.th>Total Register</x-table.th>
                                <x-table.th>Total Volunteer</x-table.th>
                                <x-table.th>Status</x-table.th>
                                <x-table.th>Action</x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($events as $event)
                            <tr>
                                <x-table.td>
                                    <a class="tw-text-indigo-600 hover:tw-text-indigo-900" href={{ Route('events.show',
                                        $event) }}>{{ $event->title }}</a>
                                </x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-M-d') . ' / ' .
                                    \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-M-d') }}</x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($event->EventStart)->format('Y-M-d') . ' / ' .
                                    \Carbon\Carbon::parse($event->EventEnd)->format('Y-M-d') }}</x-table.td>
                                <x-table.td>
                                    <a class="tw-text-indigo-600 hover:tw-text-indigo-900"
                                        href="{{ route('events.register', $event) }}">
                                        {{ $event->total_register }} Register
                                    </a>
                                </x-table.td>
                                <x-table.td>
                                    <a class="tw-text-indigo-600 hover:tw-text-indigo-900"
                                        href="{{ route('events.volunteers', $event) }}">
                                        {{ $event->total_volunteer }} Volunteers
                                    </a>
                                </x-table.td>
                                <x-table.td>{{ $event->isActive ? 'Active' : 'Inactive' }}</x-table.td>
                                <x-table.td>
                                    @if ($event->status)
                                    <a href={{ Route('events.edit', $event) }}
                                        class="tw-text-indigo-600 hover:tw-text-indigo-900">
                                        Edit
                                    </a>
                                    <button class="tw-text-red-600 hover:tw-text-red-900" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete') }}
                                    </button>
                                    @else
                                    <p class="tw-text-red-600">
                                        Deleted
                                    </p>
                                    @endif


                                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()"
                                        focusable>
                                        <form method="post" action="{{ route('events.destroy', $event) }}"
                                            class="tw-p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="tw-text-lg tw-font-medium tw-text-gray-900">
                                                {{ __('Are you sure you want to delete your events?') }}
                                            </h2>

                                            <p class="tw-mt-1 tw-text-sm tw-text-gray-600">
                                                {{ __('Once your account is deleted, all of its resources and data will
                                                be permanently deleted. ') }}
                                            </p>
                                            <div class="tw-mt-6 tw-flex tw-justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Cancel') }}
                                                </x-secondary-button>

                                                <x-danger-button class="tw-ms-3">
                                                    {{ __('Delete Event') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
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