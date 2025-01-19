<x-guest-layout>
    <h1 class="tw-text-center tw-font-bold tw-text-lg tw-pb-4">Register</h1>
    <form method="POST" action="{{ route('user-detail.store') }}">
        @csrf

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('phone')" />
            <x-text-input id="phone" class="tw-block tw-mt-1 tw-w-full" type="text" name="phone" :value="old('phone')"
                required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('name')" class="tw-mt-2" />
        </div>

        <!-- Birth Date -->
        <div class="tw-mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" class="tw-block tw-mt-1 tw-w-full" type="date" name="birth_date"
                :value="old('birth_date')" required autocomplete="birth_date" />
            <x-bladewind::datepicker />
            <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
        </div>

        <!-- City-->
        <div class="tw-mt-4">
            <x-input-label for="city" :value="__('City')" />

            <x-text-input id="city" class="tw-block tw-mt-1 tw-w-full" type="text" name="city" required
                autocomplete="city" />

            <x-input-error :messages="$errors->get('city')" class="tw-mt-2" />
        </div>

        {{-- Province --}}
        <div class="tw-mt-4">
            <x-input-label for="province" :value="__('Province')" />

            <x-text-input id="province" class="tw-block tw-mt-1 tw-w-full" type="text" name="province" required
                autocomplete="province" />

            <x-input-error :messages="$errors->get('province')" class="tw-mt-2" />
        </div>

        {{-- Country --}}
        <div class="tw-mt-4">
            <x-input-label for="country" :value="__('Country')" />

            <x-text-input id="country" class="tw-block tw-mt-1 tw-w-full" type="text" name="country" required
                autocomplete="country" />

            <x-input-error :messages="$errors->get('country')" class="tw-mt-2" />
        </div>

        {{-- Address --}}
        <div class="tw-mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-textarea-input id="address" class="tw-block tw-mt-1 tw-w-full" type="text" name="address" required
                autocomplete="address" />

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