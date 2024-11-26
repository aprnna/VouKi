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

                    {{-- title --}}
                    <div>
                        <x-input-label for="title" :value="__('Name Events')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description Events')" />
                        <x-textarea-input id="description"
                            name="description">{{ old('description') }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Max Volunteer --}}
                    <div>
                        <x-input-label for="max_volunteers" :value="__('Max Volunteesr')" />
                        <x-text-input id="max_volunteers" class="block mt-1 w-full" type="number" name="max_volunteers"
                            :value="old('max_volunteers')" />
                        <x-input-error :messages="$errors->get('max_volunteers')" class="mt-2" />
                    </div>

                    {{-- Register Date --}}
                    <div>
                        <x-input-label :value="__('Register Date')" />
                        <div class="flex items-center gap-3">
                            <div>
                                <x-date-input id="register_start" name="RegisterStart" :value="old('RegisterStart')" />
                                <x-input-error :messages="$errors->get('RegisterStart')" class="mt-2" />
                            </div>
                            <h1> to </h1>
                            <div>
                                <x-date-input id="register_end" name="RegisterEnd" :value="old('RegisterEnd')" />
                                <x-input-error :messages="$errors->get('RegisterEnd')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Event Date --}}
                    <div>
                        <x-input-label :value="__('Event Date')" />
                        <div class="flex items-center gap-3">
                            <div>
                                <x-date-input id="event_start" name="EventStart" :value="old('EventStart')" />
                                <x-input-error :messages="$errors->get('EventStart')" class="mt-2" />
                            </div>
                            <h1> to </h1>
                            <div>
                                <x-date-input id="event_end" name="EventEnd" :value="old('EventEnd')" />
                                <x-input-error :messages="$errors->get('EventEnd')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Prefered Skills --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="prefered_skills" class="block text-sm font-medium text-gray-900"> Skills </label>
                        <select name="prefered_skills" id="prefered_skills"
                            class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm input-text">
                            <option value="0">Select...</option>
                            <option value="it">IT</option>
                            <option value="design">Design</option>
                            <option value="marketing">Marketing</option>
                            <option value="finance">Finance</option>
                            <option value="comunication">Comunication</option>
                            <option value="leader">Leader</option>
                            <option value="other">Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('prefered_skills')" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="category" class="block text-sm font-medium text-gray-900"> Prefered
                            Categories </label>
                        <select name="category" id="category"
                            class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm input-text">
                            <option value="0">Select...</option>
                            <option value="music">Music</option>
                            <option value="sport">Sport</option>
                            <option value="education">Education</option>
                            <option value="technology">Technology</option>
                            <option value="art">Art</option>
                            <option value="fashion">Fashion</option>
                            <option value="food">Food</option>
                            <option value="other">Other</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    {{-- Banner --}}
                    <div>
                        <x-input-label for="banner" :value="__('Events Banner')" />
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
