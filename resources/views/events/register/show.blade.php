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
        <x-card.title>
          @php
            $volunteer = $event->volunteers()->where('user_id', $user->id)->first();
          @endphp
          @if ($volunteer->pivot->user_acceptance_status === 'pending')
          <div class="tw-flex tw-gap-2">
            <form action="{{ route('events.register.update',[$event,$user,'status'=>'rejected']) }}" method="POST">
              @csrf
              @method('put')
              <x-secondary-button type="submit">
                Reject
              </x-secondary-button>
            </form>
            <form action="{{ route('events.register.update', [$event,$user,'status'=>'accepted']) }}" method="POST">
              @csrf
              @method('put')
              <x-primary-button type="submit">
                Accept
              </x-primary-button>
            </form>
          </div>
          @endif
        </x-card.title>
        <x-card.content>
          <h1>Profile</h1>
          <x-table>
            <x-table.tbody>
              <tr>
                <x-table.td><strong>Name</strong></x-table.td>
                <x-table.td>{{ $user->name }}</x-table.td>
              </tr>
              <tr>
                <x-table.td><strong>Email</strong></x-table.td>
                <x-table.td>{{ $user->email }}</x-table.td>
              </tr>
              <tr>
                <x-table.td><strong>Phone Number</strong></x-table.td>
                <x-table.td>{{ optional($user->userDetail)->phone ?? 'N/A' }}</x-table.td>
              </tr>
              <tr>
                <x-table.td><strong>Birth Date</strong></x-table.td>
                <x-table.td>{{ optional($user->userDetail)->birth_date ?? 'N/A' }}</x-table.td>
              </tr>
              <tr>
                <x-table.td><strong>address</strong></x-table.td>
                <x-table.td>{{ optional($user->userDetail)->address ?? 'N/A' }}</x-table.td>
              </tr>
            </x-table.tbody>
          </x-table>

          <h1>Question</h1>
          <x-table>
            <x-table.thead>
              <tr>
                <x-table.th>Question</x-table.th>
                <x-table.th>Answer</x-table.th>
              </tr>
            </x-table.thead>
            <x-table.tbody>
              @foreach ($questions as $question)
              <tr>
                <x-table.td>{{ $question->question }}</x-table.td>
                <x-table.td>{{ $question->userAnswer->answer ?? 'No answer available' }}</x-table.td>
              </tr>
              @endforeach
            </x-table.tbody>
          </x-table>
        </x-card.content>
      </x-card.header>
    </x-card>
  </x-container>
</x-app-layout>
