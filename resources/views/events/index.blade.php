<x-app-layout>
  @slot('title','Events')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <x-container>
      @foreach ($events as $event)
        <div>
          <img src='{{ \Illuminate\Support\Facades\Storage::url($event->banner) }}' alt='{{ $event->name }}'>
          <h1>{{ $event->name }}</h1>
          <p>{{ $event->description }}</p>
        </div>
      @endforeach
    </x-container>
</x-app-layout>
