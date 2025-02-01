<x-app-layout>
    @slot('title', 'My Events')

    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <x-container class="tw-opacity-0 tw-translate-y-10 tw-duration-500 tw-ease-in-out tw-delay-150 hover:tw-scale-105">
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
                                <x-primary-button type="button">
                                    Create Event
                                </x-primary-button>
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
                                    <a class="tw-text-tertiary1 hover:tw-text-secondary1" href={{ Route('events.show',
                                        $event) }}>{{ $event->title }}</a>
                                </x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-M-d') . ' / ' .
                                    \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-M-d') }}</x-table.td>
                                <x-table.td>{{ \Carbon\Carbon::parse($event->EventStart)->format('Y-M-d') . ' / ' .
                                    \Carbon\Carbon::parse($event->EventEnd)->format('Y-M-d') }}</x-table.td>
                                <x-table.td>
                                    <a class="tw-text-tertiary1 hover:tw-text-secondary1"
                                        href="{{ route('events.register', $event) }}">
                                        {{ $event->total_register }} Register
                                    </a>
                                </x-table.td>
                                <x-table.td>
                                    <a class="tw-text-tertiary1 hover:tw-text-secondary1"
                                        href="{{ route('events.volunteers', $event) }}">
                                        {{ $event->total_volunteer }} Volunteers
                                    </a>
                                </x-table.td>
                                <x-table.td>
                                    <div class="tw-flex tw-items-center">
                                        <div class="tw-h-2.5 tw-w-2.5 tw-rounded-full {{ $event->isActive ? 'tw-bg-green-500' : 'tw-bg-red-500'}}  tw-me-2"></div> {{ $event->isActive ? 'Active' : 'Inactive' }}
                                    </div>
                                </x-table.td>
                                <x-table.td>
                                    @if ($event->status)
                                    <a href={{ Route('events.edit', $event) }}>
                                        <x-primary-button type="button">
                                            Edit
                                        </x-primary-button>
                                    </a>
                                    <x-secondary-button class="" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete') }}
                                    </x-secondary-button>
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
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                const elements = document.querySelectorAll('.tw-opacity-0');
                elements.forEach((element, index) => {
                    setTimeout(() => {
                        element.classList.remove('tw-opacity-0', 'tw-translate-y-10');
                    }, index * 150);
                });
            });
    </script>
</x-app-layout>
