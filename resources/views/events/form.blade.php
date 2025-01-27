<x-app-layout>
    @slot('title', 'Create Events')

    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ $page_meta['title'] }}
        </h2>
    </x-slot>
    <x-container>
        <x-card>
            @if ($page_meta['progress'])
            <x-progress-create-event step='1' />
            @endif
            <x-card.header>
                <x-card.title>{{ $page_meta['title'] }}</x-card.title>
                <x-card.description>{{ $page_meta['description'] }}</x-card.description>
            </x-card.header>
            <x-card.content>
                <form id="form-create-event" action={{ $page_meta['url'] }} method="POST"
                    class="tw-space-y-3 tw-relative" enctype="multipart/form-data">
                    @method($page_meta['method'])
                    @csrf
                    @if ($page_meta['progress'])
                    <input type="hidden" name="redirect" value="events.questions.create">
                    @else
                    <input type="hidden" name="redirect" value="events.my">
                    @endif
                    {{-- title --}}
                    <div>
                        <x-input-label for="title" :value="__('Name Events')" />
                        <x-bladewind::input id="title" name="title" :value="old('title', $event->title)" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="tw-mt-2" />
                    </div>

                    {{-- description --}}
                    <div>
                        <x-input-label for="description" :value="__('Description Events')" />
                        <x-bladewind::textarea id="description" name="description" placeholder="Description Event"
                            :selected_value="old('description', $event->description)" />
                        <x-input-error :messages="$errors->get('description')" class="tw-mt-2" />
                    </div>
                    {{-- Prefered Skills --}}
                    <div>
                        <x-input-label for="skills" :value="__('Prefered Skills')" class="mb-3" />
                        <x-bladewind::select id="skills" name="skills" searchable="true" label_key="skill"
                            value_key="id" flag_key="skill" multiple="true" label="Select a skill" max_selectable="3"
                            :data="$skills" :selected_value="old('skills', implode(',', $user_skills->toArray()))" />
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div>
                        <x-input-label for="categories" :value="__('Categories')" class="mb-3" />
                        <x-bladewind::select name="categories" searchable="true" label_key="category" value_key="id"
                            flag_key="category" multiple="true" label="Select a category" max_selectable="3"
                            :data="$categories"
                            :selected_value="old('categories', implode(',', $user_skills->toArray()))" />
                        <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                    </div>

                    {{-- Max Volunteer --}}
                    <div>
                        <x-input-label for="max_volunteers" :value="__('Max Volunteesr')" />
                        <x-bladewind::input id="max_volunteers" type="number" name="max_volunteers"
                            :value="old('max_volunteers', $event->max_volunteers)" />
                        <x-input-error :messages="$errors->get('max_volunteers')" class="tw-mt-2" />
                    </div>

                    {{-- Register Date --}}
                    <div>
                        <x-input-label :value="__('Register Date')" class="tw-mb-5" />
                        <x-bladewind::datepicker type="range" date_from_name="RegisterStart" date_to_name="RegisterEnd"
                            :default_date_from="old('RegisterStart', $event->RegisterStart)"
                            :default_date_to="old('RegisterEnd', $event->RegisterEnd)" class="text-black"
                            format="yyyy-mm-dd" class="tw-z-50" />
                    </div>

                    {{-- Event Date --}}
                    <div>
                        <x-input-label :value="__('Event Date')" class="tw-mb-5" />
                        <x-bladewind::datepicker type="range" date_from_name="EventStart" date_to_name="EventEnd"
                            class="text-black" format="yyyy-mm-dd" class="tw-z-50"
                            :default_date_from="old('EventStart', $event->EventStart)"
                            :default_date_to="old('EventEnd', $event->EventEnd)" />
                        <x-input-error :messages="$errors->get('EventStart')" class="mt-2" />
                    </div>


                    {{-- Banner --}}
                    <div>
                        <x-input-label for="banner" :value="__('Events Banner')" />
                        <x-bladewind::filepicker name="banner" accepted_file_types=".png, .jpeg, .jpg" />
                        <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                    </div>

                    {{-- MAPS --}}
                    <x-input-label :value="__('Select Location Event')" />
                    <div class="tw-flex tw-gap-10 tw-flex-wrap">
                        <div class="tw-flex-grow tw-z-0">
                            <div id="map" style="height: 50vh;"></div>

                            <p>
                                You can drag the marker to select the location
                            </p>
                        </div>
                        <div class="tw-space-y-4">
                            <div>
                                <x-input-label for="latitude" :value="__('Latitude')" />
                                <x-text-input readonly id="latitude" class="tw-block tw-mt-1 tw-w-full" type="text"
                                    name="latitude" :value="old('latitude',$event->latitude)" />
                                <x-input-error :messages="$errors->get('latitude')" class="tw-mt-2" />
                            </div>
                            <div>
                                <x-input-label for="longitude" :value="__('Longitude')" />
                                <x-text-input readonly id="longitude" class="tw-block tw-mt-1 tw-w-full" type="text"
                                    name="longitude" :value="old('longitude', $event->longitude)" />
                                <x-input-error :messages="$errors->get('longitude')" class="tw-mt-2" />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input readonly id="city" class="tw-block tw-mt-1 tw-w-full" type="text"
                                    name="city" :value="old('city', $event->city)" />
                                <x-input-error :messages="$errors->get('city')" class="tw-mt-2" />
                            </div>
                            <div>
                                <x-input-label for="province" :value="__('Province')" />
                                <x-text-input readonly id="province" class="tw-block tw-mt-1 tw-w-full" type="text"
                                    name="province" :value="old('province', $event->province)" />
                                <x-input-error :messages="$errors->get('province')" class="tw-mt-2" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input readonly id="country" class="tw-block tw-mt-1 tw-w-full" type="text"
                                    name="country" :value="old('country', $event->country)" />
                                <x-input-error :messages="$errors->get('country')" class="tw-mt-2" />
                            </div>
                        </div>
                    </div>
                    {{-- Detail Location --}}
                    <div>
                        <x-input-label for="detail_location" :value="__('Detail Location')" />
                        <x-bladewind::textarea id="detail_location" name="detail_location" placeholder="Detail Location"
                            :selected_value="old('detail_location', $event->detail_location)" />
                        <x-input-error :messages="$errors->get('detail_location')" class="tw-mt-2" />
                    </div>


                </form>
            </x-card.content>
            <x-card.footer class="tw-flex tw-justify-end">
                @if (!$page_meta['progress'] )
                <a href={{ route('events.questions.edit', isset($event)) }}>
                    <x-secondary-button>
                        Edit Question
                    </x-secondary-button>
                </a>
                <a href={{ route('events.my') }}>
                    <x-secondary-button>
                        Back
                    </x-secondary-button>
                </a>
                @endif
                <x-primary-button form="form-create-event">
                    {{ $page_meta['progress'] ? 'Next' : 'Save' }}
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