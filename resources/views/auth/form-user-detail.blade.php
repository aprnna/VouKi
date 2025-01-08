<x-guest-layout>
    <h1 class="text-center font-bold text-lg pb-4">Register</h1>
    <form method="POST" action="{{ route('user-detail.store') }}">
        @csrf

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Birth Date -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')"
                required autocomplete="birth_date" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- City-->
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />

            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" required
                autocomplete="city" />

            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        {{-- Province --}}
        <div class="mt-4">
            <x-input-label for="province" :value="__('Province')" />

            <x-text-input id="city" class="block mt-1 w-full" type="text" name="province" required
                autocomplete="province" />

            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>

        {{-- Country --}}
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />

            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" required
                autocomplete="country" />

            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        {{-- Address --}}
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />

            <x-textarea-input id="address" class="block mt-1 w-full" type="text" name="address" required
                autocomplete="address" />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('event.index') }}">
                {{ __('Skip') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
