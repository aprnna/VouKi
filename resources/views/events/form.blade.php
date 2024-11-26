<x-app-layout>
    @slot('title', 'Create Events')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $page_meta['title'] }}
        </h2>
    </x-slot>
    <x-container>
        <x-card>
            <x-card.header>
                <x-card.title>{{ $page_meta['title'] }}</x-card.title>
                <x-card.description>{{ $page_meta['description'] }}</x-card.description>
            </x-card.header>
            <x-card.content>
                <form id="form-create-event" action={{ $page_meta['url'] }} method="POST" class="space-y-3"
                    enctype="multipart/form-data">
                    @method($page_meta['method'])
                    @csrf

                    {{-- title --}}
                    <div>
                        <x-input-label for="title" :value="__('Name Events')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $event->title)" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description Events')" />
                        <x-textarea-input id="description"
                            name="description">{{ old('description', $event->description) }}</x-textarea-input>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Max Volunteer --}}
                    <div>
                        <x-input-label for="max_volunteers" :value="__('Max Volunteesr')" />
                        <x-text-input id="max_volunteers" class="block mt-1 w-full" type="number" name="max_volunteers"
                            :value="old('max_volunteers', $event->max_volunteers)" />
                        <x-input-error :messages="$errors->get('max_volunteers')" class="mt-2" />
                    </div>

                    {{-- Register Date --}}
                    <div>
                        <x-input-label :value="__('Register Date')" />
                        <div class="flex items-center gap-3">
                            <div>
                                <x-date-input id="register_start" name="RegisterStart" :value="old('RegisterStart', $event->RegisterStart)" />
                                <x-input-error :messages="$errors->get('RegisterStart')" class="mt-2" />
                            </div>
                            <h1> to </h1>
                            <div>
                                <x-date-input id="register_end" name="RegisterEnd" :value="old('RegisterEnd', $event->RegisterEnd)" />
                                <x-input-error :messages="$errors->get('RegisterEnd')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Event Date --}}
                    <div>
                        <x-input-label :value="__('Event Date')" />
                        <div class="flex items-center gap-3">
                            <div>
                                <x-date-input id="event_start" name="EventStart" :value="old('EventStart', $event->EventStart)" />
                                <x-input-error :messages="$errors->get('EventStart')" class="mt-2" />
                            </div>
                            <h1> to </h1>
                            <div>
                                <x-date-input id="event_end" name="EventEnd" :value="old('EventEnd', $event->EventEnd)" />
                                <x-input-error :messages="$errors->get('EventEnd')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Prefered Skills --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="prefered_skills" class="block text-sm font-medium text-gray-900"> Skills </label>
                        <x-select name="prefered_skills" id="prefered_skills">
                            <x-select.option :event="$event->prefered_skills" :value="'0'">Select...</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'it'">IT</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'design'">Design</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'marketing'">Marketing</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'finance'">Finance</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'comunication'">Comunication</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'leader'">Leader</x-select.option>
                            <x-select.option :event="$event->prefered_skills" :value="'other'">Other</x-select.option>
                        </x-select>
                        <x-input-error :messages="$errors->get('prefered_skills')" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="category" class="block text-sm font-medium text-gray-900"> Prefered
                            Categories </label>
                        <x-select name="category" id="category">
                            <x-select.option :event="$event->category" :value="'0'">Select...</x-select.option>
                            <x-select.option :event="$event->category" :value="'music'">Music</x-select.option>
                            <x-select.option :event="$event->category" :value="'sport'">Sport</x-select.option>
                            <x-select.option :event="$event->category" :value="'education'">Education</x-select.option>
                            <x-select.option :event="$event->category" :value="'technology'">Technology</x-select.option>
                            <x-select.option :event="$event->category" :value="'art'">Art</x-select.option>
                            <x-select.option :event="$event->category" :value="'fashion'">Fashion</x-select.option>
                            <x-select.option :event="$event->category" :value="'food'">Food</x-select.option>
                            <x-select.option :event="$event->category" :value="'other'">Other</x-select.option>
                        </x-select>
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
                    Save
                </x-primary-button>
            </x-card.footer>
        </x-card>
    </x-container>
</x-app-layout>
