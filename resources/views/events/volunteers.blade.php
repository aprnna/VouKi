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
                            </tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($volunteers as $volunteer)
                                @dump($volunteer)
                                <tr>
                                    <x-table.td>{{ $volunteer->name }}</x-table.td>
                                    <x-table.td>{{ $volunteer->email }}</x-table.td>
                                    <x-table.td>{{ \Carbon\Carbon::parse($event->created_at)->format('Y-m-d') }}</x-table.td>
                                </tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                </x-card.content>
            </x-card.header>
        </x-card>
    </x-container>
</x-app-layout>
