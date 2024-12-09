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
                    <div>
                        <x-input-label for="skills" :value="__('Prefered Skills')" class="mb-3" />
                        <x-bladewind::select id="skills" name="skills" searchable="true" label_key="skill"
                            value_key="id" flag_key="skill" multiple="true" label="Select a skill" max_selectable="3"
                            :data="$skills" />
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div>
                        <x-input-label for="categories" :value="__('Categories')" class="mb-3" />
                        <x-bladewind::select name="categories" searchable="true" label_key="category" value_key="id"
                            flag_key="category" multiple="true" label="Select a category" max_selectable="3"
                            :data="$categories" />
                        <x-input-error :messages="$errors->get('categories')" class="mt-2" />
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
