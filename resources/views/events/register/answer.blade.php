<x-app-layout>
  @slot('title', 'My Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      {{ __('My Events') }}
    </h2>
  </x-slot>

  <x-container>
    <x-card>
      <x-card.header>
        <x-card.title>
          {{ $event->title }}
        </x-card.title>
        <x-card.description>
          <div class="tw-sm:flex tw-sm:items-center">
            <p class="tw-sm:flex-auto tw-mt-2 tw-text-sm tw-text-gray-700">
              Please fill out the form below to register for the event. Your answers will help us to better organize the
              event and ensure it meets your needs.
            </p>
          </div>
        </x-card.description>
        <x-card.content>
          <form action="{{ route('events.answer.store', $event) }}" method="POST">
            @csrf
            @foreach ($questions as $question)
            <div class="tw-mb-4">
              <label for="answers[{{ $question->id }}]" class="tw-block tw-font-medium tw-text-gray-700">
                {{ $question->question }}
              </label>
              <input type="text" name="answers[{{ $question->id }}]" id="answers[{{ $question->id }}]"
                class="tw-mt-1 tw-block tw-w-full tw-border-gray-300 tw-rounded-md shadow-sm focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm"
                value="{{ old('answers.' . $question->id) }}">
              @error('answers.' . $question->id)
              <p class="tw-text-red-500 tw-text-sm">{{ $message }}</p>
              @enderror
            </div>
            @endforeach
            <button type="submit" class="tw-mt-4 tw-px-4 tw-py-2 tw-bg-indigo-600 tw-text-white tw-rounded-md">
              Submit Answers
            </button>
          </form>
        </x-card.content>
      </x-card.header>
    </x-card>
  </x-container>
</x-app-layout>