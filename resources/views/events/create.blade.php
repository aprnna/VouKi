<x-app-layout>
    @slot('title', 'Create Events')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Events') }}
        </h2>
    </x-slot>

    <x-container>
        <x-card>
            <x-card.header>
                <x-card.title>Create Event</x-card.title>
                <x-card.description>You can create event</x-card.description>
            </x-card.header>
            <x-card.content>
                <form id="form-create-event" action={{ Route('events.store') }} method="POST" class="space-y-3"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="title" :value="__('Name Events')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Description Events')" />
                        <x-textarea-input id="description"
                            name="description">{{ old('description') }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="banner" :value="__('Description Events')" />
                        <x-text-input id="banner" class="block mt-1 w-full" type="file" name="banner"
                            :value="old('description')" />
                        <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>
                </form>
            </x-card.content>
            <x-card.footer>
                <x-primary-button form="form-create-event">
                    Create
                </x-primary-button>
            </x-card.footer>
        </x-card>
    </x-container>
</x-app-layout>
