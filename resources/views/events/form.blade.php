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

                    {{-- MAPS --}}
                    <x-input-label :value="__('Select Location Event')" />
                    <div class="flex gap-10 flex-wrap">
                        <div class="flex-grow">
                            <div id="map" style="height: 50vh;"></div>

                            <p>
                                You can drag the marker to select the location
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="latitude" :value="__('Latitude')" />
                                <x-text-input readonly id="latitude" class="block mt-1 w-full" type="text"
                                    name="latitude" :value="old('latitude')" />
                                <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="longitude" :value="__('Longitude')" />
                                <x-text-input readonly id="longitude" class="block mt-1 w-full" type="text"
                                    name="longitude" :value="old('longitude')" />
                                <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input readonly id="city" class="block mt-1 w-full" type="text"
                                    name="city" :value="old('city')" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="province" :value="__('Province')" />
                                <x-text-input readonly id="province" class="block mt-1 w-full" type="text"
                                    name="province" :value="old('province')" />
                                <x-input-error :messages="$errors->get('province')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input readonly id="country" class="block mt-1 w-full" type="text"
                                    name="country" :value="old('country')" />
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                        </div>
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

    <x-slot name="scripts">
        <script>
            const providerOSM = new GeoSearch.OpenStreetMapProvider();
            var latitude = document.querySelector("[name=latitude]")
            var longitude = document.querySelector("[name=longitude]")
            var city = document.querySelector("[name=city]")
            var province = document.querySelector("[name=province]")
            var country = document.querySelector("[name=country]")

            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });

            var map = L.map('map', {
                center: [-5.129541583080711, 113.62957770241515],
                zoom: 5,
                layers: [osm]
            })

            const search = new GeoSearch.GeoSearchControl({
                provider: providerOSM,
                style: 'bar',
                autoComplete: true,
                searchLabel: 'Masukkan Lokasi',
                marker: {
                    draggable: true,
                },
            });

            map.addControl(search);
            map.on('geosearch/showlocation', UpdateInput);
            map.on('geosearch/marker/dragend', UpdateInputDrag);

            function UpdateInput(e) {
                console.log(e)
                const location = e.location.label.split(",")
                city.value = location[0]
                province.value = location[1]
                country.value = location.at(-1)
                latitude.value = e.location.x
                longitude.value = e.location.y
            }

            function UpdateInputDrag(e) {
                console.log(e)
                latitude.value = e.location.lat
                longitude.value = e.location.lng
            }

            var lc = L.control
                .locate({
                    position: "topright",
                    strings: {
                        title: "Show me where I am, yo!"
                    }
                })
                .addTo(map);

            // Get My Location
            map.on('locationfound', function(e) {
                var coordinates = e.latlng;
                console.log("Coordinates: ", coordinates);
            });
        </script>
    </x-slot>
</x-app-layout>
