<x-app-layout>
  @slot('title','Create Events')

  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Create Events') }}
      </h2>
  </x-slot>

  <x-container>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
              <h1>Create Events</h1>
          </div>
          <form action={{ Route('events.store') }} method="POST" class="p-4" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name Events')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
              <x-input-label for="description" :value="__('Description Events')" />
              <x-textarea-input id="description" name="description" >{{ old('description') }}</x-textarea-input>
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
              <x-input-label for="banner" :value="__('Description Events')" />
              <x-text-input id="banner" class="block mt-1 w-full" type="file" name="banner" :value="old('description')" />
              <x-input-error :messages="$errors->get('banner')" class="mt-2" />
            </div>
            <x-primary-button>
              Create
            </x-primary-button>
          </form>
      </div>
  </x-container>
</x-app-layout>
