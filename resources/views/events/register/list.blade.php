<x-app-layout>
  @slot('title', 'My Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      {{ __('My Events') }}
    </h2>
  </x-slot>

  <x-container>
    @if(session('status'))
    <x-bladewind::alert type="success">
      {{ session('status') }}
    </x-bladewind::alert>
    @endif

    <x-card>
      <x-card.header>
        <x-card.title>List Register Event</x-card.title>
        <x-card.description>
          <div class="tw-sm:flex tw-sm:items-center">
            <p class="tw-sm:flex-auto tw-mt-2 tw-text-sm tw-text-gray-700">
              A list of all the users in your account including their name, title, email and role.
            </p>
          </div>
        </x-card.description>
        @dump($event->getRegisterEvent())

        <x-card.content>
          <x-table>
            <x-table.thead>
              <tr>
                <x-table.th>Name</x-table.th>
                <x-table.th>Answer</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Register Date</x-table.th>
                <x-table.th>Action</x-table.th>
              </tr>
            </x-table.thead>
            <x-table.tbody>
              @foreach ($event->getRegisterEvent() as $user)
              <tr>
                <x-table.td>{{ $user->name }}</x-table.td>
              </tr>
              @endforeach
            </x-table.tbody>
          </x-table>
        </x-card.content>
      </x-card.header>
    </x-card>
  </x-container>
</x-app-layout>