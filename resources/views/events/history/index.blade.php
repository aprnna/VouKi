<x-app-layout>
  @slot('title', 'Organizer')
  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      Event History
    </h2>
  </x-slot>
  <x-container>
    {{-- <div class="bg-white tw-w-full tw-flex tw-justify-end tw-items-center tw-shadow tw-p-2 tw-rounded tw-my-8">
      <form action="{{ route('organizer.index') }}" method="GET" class="tw-w-full">
        <label for="searchOrganizer" class="flex tw-h-full tw-items-center tw-border rounded">
          <input type="hidden" name="category" value="{{ $currentCategoryId }}">
          <input type="text" value="{{ request()->input('searchOrganizer') }}" name="searchOrganizer"
            id="searchOrganizer" class="tw-w-full tw-h-full tw-border-none rounded"
            placeholder="Search Name Organizer" />
          <button type="submit" class="tw-bg-tertiary1 tw-h-full tw-text-white tw-p-2 tw-rounded-tr tw-rounded-br">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search"
              viewBox="0 0 16 16">
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
          </button>
        </label>
      </form>
    </div> --}}

    <div class="tw-w-full tw-mb-8 tw-gap-5 tw-flex tw-flex-col">
      <h1>Ongoing Event</h1>
      @foreach ($events as $event)
      {{-- Ambil history event yang belum di review --}}
      @if($event->pivot->event_rating == null)
      <a href="{{ route('events.show', $event) }}"
        class="tw-w-full tw-bg-white tw-flex tw-items-center tw-justify-center tw-cursor-pointer tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg tw-duration-500 tw-ease-in-out hover:tw-scale-105">
        <div class="w-full tw-flex tw-justify-between tw-p-4 tw-gap-2 tw-flex-wrap lg:tw-flex-nowrap">
          <div class="tw-flex tw-gap-4 tw-items-center">
            @if (isset($event->banner))
            <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}" class="tw-w-16 tw-h-16" />
            @else
            <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}" class="tw-w-16 tw-h-16" />
            @endif
            <div class="tw-flex tw-flex-col tw-gap-2">
              <h2 class="tw-text-sm tw-font-bold">{{ $event->title }}</h2>
              <span class="tw-text-xs">{{ $event->organizer->userDetail->address }}</span>
              <div class="tw-flex tw-text-sm tw-gap-2 tw-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-calendar-week" viewBox="0 0 16 16">
                  <path
                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                  <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                <p>{{ $event->EventStart }} - {{ $event->EventEnd }}</p>
              </div>
              <div class="tw-flex tw-gap-2 tw-items-center">
                <div class="tw-h-4">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill tw-h-full"
                    viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                  </svg>
                </div>
                <p class="tw-text-xs">{{ $event->detail_location }}</p>
                <p class="tw-text-xs">Join Date: {{ $event->pivot->created_at }}</p>
              </div>
            </div>
          </div>
          <div class="tw-flex tw-flex-col tw-items-center tw-justify-end">
            @if($event->pivot->user_acceptance_status == 'pending')
            <h1 class="tw-text-tertiary1">Waiting for confirmation</h1>
            @elseif($event->pivot->user_acceptance_status == 'accepted' )
            <h1 class={{ $event->EventEnd < date('Y-m-d') ?'tw-text-yellow-600' : 'tw-text-green-500' }}>
                {{ $event->EventEnd < date('Y-m-d') ? 'Need review' : 'Accepted' }}</h1>
                  @elseif ($event->pivot->user_acceptance_status == 'rejected')
                  <h1 class="tw-text-red-900">Rejected</h1>
                  @endif
          </div>
        </div>
      </a>
      @endif
      @endforeach
      <h1>Reviewed Event</h1>
      @foreach ($events as $event)
      {{-- Ambil history event yang belum di review --}}
      @if($event->pivot->event_rating != null)
      <a href="{{ route('events.show', $event) }}"
        class="tw-w-full tw-bg-white tw-flex tw-items-center tw-justify-center tw-cursor-pointer tw-rounded-lg tw-shadow tw-transition hover:tw-shadow-lg tw-duration-500 tw-ease-in-out hover:tw-scale-105">
        <div class="w-full tw-flex tw-justify-between tw-p-4 tw-gap-2 tw-flex-wrap lg:tw-flex-nowrap">
          <div class="tw-flex tw-gap-4 tw-items-center">
            @if (isset($event->banner))
            <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}" class="tw-w-16 tw-h-16" />
            @else
            <img src="{{ asset('images/banner_default.webp') }}" alt="{{ $event->title }}" class="tw-w-16 tw-h-16" />
            @endif
            <div class="tw-flex tw-flex-col tw-gap-2">
              <h2 class="tw-text-sm tw-font-bold">{{ $event->title }}</h2>
              <span class="tw-text-xs">{{ $event->organizer->userDetail->address }}</span>
              <div class="tw-flex tw-text-sm tw-gap-2 tw-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-calendar-week" viewBox="0 0 16 16">
                  <path
                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                  <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                <p>{{ $event->EventStart }} - {{ $event->EventEnd }}</p>
              </div>
              <div class="tw-flex tw-gap-2 tw-items-center">
                <div class="tw-h-4">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-alt-fill tw-h-full"
                    viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                  </svg>
                </div>
                <p class="tw-text-xs">{{ $event->detail_location }}</p>
                <p class="tw-text-xs">Join Date: {{ $event->pivot->created_at }}</p>
              </div>
            </div>
          </div>
          <div class="tw-flex tw-flex-col tw-items-center tw-justify-end">
            <div class="tw-flex flex-col tw-h-full tw-justify-center tw-text-sm tw-items-center tw-px-3">
              <div class="tw-flex tw-items-center tw-gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                  class="bi bi-star-fill tw-w-4 tw-text-yellow-400" viewBox="0 0 16 16">
                  <path
                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>
                {{ number_format($event->pivot->event_rating, 1) }}
              </div>
              <h1>Rating</h1>
            </div>
          </div>
        </div>
      </a>
      @endif
      @endforeach
    </div>
  </x-container>
</x-app-layout>