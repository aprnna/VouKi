<x-guest-layout>
    <h1 class="tw-text-center tw-font-bold tw-text-lg tw-pb-4">Register</h1>
    <form method="POST" action="{{ route('user-detail.store') }}">
        @csrf

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            {{--
            <x-text-input id="phone" class="tw-block tw-mt-1 tw-w-full" type="text" name="phone" :value="old('phone')"
                required autofocus autocomplete="phone" /> --}}
            <x-bladewind::input name="phone" :value="old('phone')" placeholder="08XXXXXXXXX" />
            <x-input-error :messages="$errors->get('name')" class="tw-mt-2" />
        </div>

        <!-- Birth Date -->
        <div class="tw-mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-bladewind::datepicker placeholder="Birth Date" name="birth_date" format="yyyy-mm-dd" />
            <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
        </div>

        {{--
        <!-- City-->
        <div class="tw-mt-4">
            <x-input-label for="city" :value="__('City')" />

            <x-text-input id="city" class="tw-block tw-mt-1 tw-w-full" type="text" name="city" required
                autocomplete="city" />

            <x-input-error :messages="$errors->get('city')" class="tw-mt-2" />
        </div>

        <!-- Province -->
        <div class="tw-mt-4">
            <x-input-label for="province" :value="__('Province')" />

            <x-text-input id="province" class="tw-block tw-mt-1 tw-w-full" type="text" name="province" required
                autocomplete="province" />

            <x-input-error :messages="$errors->get('province')" class="tw-mt-2" />
        </div>

        <!-- Country -->
        <div class="tw-mt-4">
            <x-input-label for="country" :value="__('Country')" />

            <x-text-input id="country" class="tw-block tw-mt-1 tw-w-full" type="text" name="country" required
                autocomplete="country" />

            <x-input-error :messages="$errors->get('country')" class="tw-mt-2" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>
        --}}

        <!-- Skills -->
        <div class="mt-3">
            <x-input-label for="skills" :value="__('Prefered Skills')" class="mb-3" />
            <x-bladewind::select id="skills" name="skills" searchable="true" label_key="skill" value_key="id"
                flag_key="skill" multiple="true" max_selectable="3" :data="$skills" />
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        {{-- Category --}}
        <div>
            <x-input-label for="categories" :value="__('Categories')" class="mb-3" />
            <x-bladewind::select name="categories" searchable="true" label_key="category" value_key="id"
                flag_key="category" multiple="true" max_selectable="3" :data="$categories" />
            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
        </div>

        {{-- Address --}}
        <div class="tw-mt-4">
            <x-input-label for="address" :value="__('Address')" />
            {{--
            <x-textarea-input id="address" class="tw-block tw-mt-1 tw-w-full" type="text" name="address" required
                autocomplete="address" /> --}}
            <x-bladewind::textarea name="address" placeholder="Address" required />
            <x-input-error :messages="$errors->get('address')" class="tw-mt-2" />
        </div>


        <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
            <a class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500"
                href="{{ route('event.index') }}">
                {{ __('Skip') }}
            </a>
            <x-primary-button class="tw-ms-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>