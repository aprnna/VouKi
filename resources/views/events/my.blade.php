<x-app-layout>
    @slot('title', 'My Events')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-card.header>
                <x-card.title>My Event</x-card.title>
                <x-card.description>
                    <div class="sm:flex sm:items-center">
                        <p class="sm:flex-auto mt-2 text-sm text-gray-700">
                            A list of all the users in your account including their name, title, email and role.
                        </p>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <button type="button"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Add user
                            </button>
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
                                <x-table.th>Prefered Skills</x-table.th>
                                <x-table.th>Category</x-table.th>
                                <x-table.th>Action</x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <x-table.td>{{ $event->title }}</x-table.td>
                                    <x-table.td>{{ \Carbon\Carbon::parse($event->RegisterStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->RegisterEnd)->format('Y-m-d') }}</x-table.td>
                                    <x-table.td>{{ \Carbon\Carbon::parse($event->EventStart)->format('Y-m-d') . ' - ' . \Carbon\Carbon::parse($event->EventEnd)->format('Y-m-d') }}</x-table.td>
                                    <x-table.td>{{ $event->prefered_skills }}</x-table.td>
                                    <x-table.td>{{ $event->category }}</x-table.td>
                                    <x-table.td>
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                            Edit
                                        </a>
                                        <button class="text-red-600 hover:text-red-900" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                            {{ __('Delete') }}
                                        </button>

                                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="post" action="{{ route('events.destroy', $event) }}"
                                                class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete your events?') }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. ') }}
                                                </p>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
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
