<x-app-layout>
  @slot('title', 'Create Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      Create Event
    </h2>
  </x-slot>
  <x-container>

    <x-card>
      <x-progress-create-event step="{{ $event->isActive ? '4': '3' }}" />
      <x-card.header>
        <x-card.title>Activate your Event</x-card.title>
        <x-card.description>You can active your event right now</x-card.description>
      </x-card.header>
      <x-card.content>
        @if($event->isActive)
        <x-bladewind::empty-state message="Awesome! Your Event Is Ready" button_label="Go to Dashboard"
          onclick="window.location.href='{{ route('events.my') }}'">
        </x-bladewind::empty-state>
        @else
        <x-card class="tw-shadow-lg tw-border-black/20 tw-border-2">
          <x-card.header class="tw-text-center">
            <x-card.title>Event Preview</x-card.title>
          </x-card.header>
          <x-card.content>
            <img src="{{ route('private.file', basename($event->banner)) }}" alt="{{ $event->title }}"
              class="tw-rounded-lg tw-h-64 tw-w-2/3 tw-object-cover" />
            <h3><strong>Title:</strong> {{ $event->title }}</h3>
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Register Date:</strong> {{ \Carbon\Carbon::parse($event->RegisterStart)->format('d-M-Y') }} / {{
              \Carbon\Carbon::parse($event->RegisterEnd)->format('d-M-Y') }}</p>
            <p><strong>Activity Date:</strong> {{ \Carbon\Carbon::parse($event->EventStart)->format('d-M-Y') }} / {{
              \Carbon\Carbon::parse($event->EventEnd)->format('d-M-Y') }}</p>
            <p><strong>City:</strong>{{ $event->city }}</p>
            <p><strong>Province:</strong>{{ $event->province }}</p>
            <p><strong>Country:</strong>{{ $event->country }}</p>
            <p><strong>Detail Location:</strong>{{ $event->detail_location }}</p>
            <p><strong>Category:</strong>
              @foreach($event->categories as $category)
              {{ $category->category }},
              @endforeach
            </p>
            <p><strong>Skills:</strong>
              @foreach($event->skills as $skill)
              {{ $skill->skill }},
              @endforeach
            </p>

          </x-card.content>
          <x-card.footer class="tw-flex tw-justify-center">
            <a href="{{ route('events.edit', [$event, 'step'=>1]) }}">
              <x-bladewind::button size="small" outline="true">
                Edit Event
              </x-bladewind::button>
            </a>
          </x-card.footer>
        </x-card>

        <x-card class="tw-shadow-lg tw-border-black/20 tw-border-2">
          <x-card.header>
            <x-card.title>Event Questions</x-card.title>
          </x-card.header>
          <x-card.content>
            @foreach($event->questions as $question)
            <div>
              <p><strong>Question {{ $loop->iteration }}: </strong> {{ $question->question }}</p>
            </div>
            @endforeach
          </x-card.content>
          <x-card.footer class="tw-flex tw-justify-center">
            <a href="{{ route('events.questions.create', $event) }}">
              <x-bladewind::button size="small" outline="true">
                Edit Question
              </x-bladewind::button>
            </a>
          </x-card.footer>
        </x-card>
        <div class="tw-flex tw-justify-end tw-mt-4">
          <form method="POST" action={{ route("events.active", $event) }}>
            @csrf
            @method('PUT')
            <x-bladewind::button can_submit="true" size="small" on>
              Activate Event
            </x-bladewind::button>
          </form>
        </div>
        @endif
      </x-card.content>
    </x-card>
  </x-container>
</x-app-layout>