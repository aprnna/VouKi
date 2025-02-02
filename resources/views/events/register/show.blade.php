<x-app-layout>
  @slot('title', 'My Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      {{ __('My Events') }}
    </h2>
  </x-slot>

  <div x-data 
       x-init="$nextTick(() => { $el.classList.add('show') })" 
       class="page-transition">
    <x-container>
      <x-alert-status />
      <x-card>
        <x-card.header>
          <x-card.title>
            @php
              $volunteer = $event->volunteers()->where('user_id', $user->id)->first();
            @endphp
          </x-card.title>
          <x-card.content>
            <h1 class="tw-text-xl tw-font-semibold tw-text-gray-900">Profile</h1>
            <p class="tw-mt-1 tw-text-sm tw-text-gray-600">"Profil seorang volunteer."</p>
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
                  <x-table.td><strong>Address</strong></x-table.td>
                  <x-table.td>{{ optional($user->userDetail)->address ?? 'N/A' }}</x-table.td>
                </tr>
              </x-table.tbody>
            </x-table>
  
            <h1 class="tw-text-xl tw-font-semibold tw-text-gray-900">Question</h1>
            <p class="tw-mt-1 tw-text-sm tw-text-gray-600">"Pertanyaan-pertanyaan yang diberikan kepada Volunteer"</p>
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
            @if ($volunteer->pivot->user_acceptance_status === 'pending')
              <h2 class="tw-text-xl tw-font-semibold tw-text-gray-800">Do you want to accept it?</h2>
              <div class="tw-flex tw-gap-2 tw-mt-2">
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
          </x-card.content>
        </x-card.header>
      </x-card>
    </x-container>
  </div>

  <style>
    .page-transition {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.5s ease-out;
    }

    .page-transition.show {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</x-app-layout>
