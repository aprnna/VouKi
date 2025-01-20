<section>
    <header>
        <h2 class="tw-text-lg tw-font-medium tw-text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="tw-mt-1 tw-text-sm tw-text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="tw-mt-6 tw-space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="tw-mt-1 tw-block tw-w-full"
                :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="tw-mt-1 tw-block tw-w-full"
                :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
            <div>
                <p class="tw-text-sm tw-mt-2 tw-text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="tw-underline tw-text-sm tw-text-gray-600 hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="tw-mt-2 tw-font-medium tw-text-sm tw-text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>
        {{-- Phone --}}
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="tw-mt-1 tw-block
                tw-w-full" :value="old('phone', $detail?->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('phone')" />
        </div>
        <!-- Skills -->
        <div class="mt-3">
            <x-input-label for="skills" :value="__('Prefered Skills')" class="mb-3" />
            <x-bladewind::select id="skills" name="skills" searchable="true" label_key="skill" value_key="id"
                flag_key="skill" multiple="true" max_selectable="3" :data="$skills"
                :selected_value="implode(',', $user_skills->toArray())" />
            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
        </div>

        {{-- Category --}}
        <div>
            <x-input-label for="categories" :value="__('Categories')" class="mb-3" />
            <x-bladewind::select name="categories" searchable="true" label_key="category" value_key="id"
                flag_key="category" multiple="true" max_selectable="3" :data="$categories"
                :selected_value="implode(',', $user_categories->toArray())" />
            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
        </div>
        {{-- Skills --}}
        {{-- City --}}
        {{-- <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="tw-mt-1 tw-block
            tw-w-full" :value="old('city', $detail?->city)" required autofocus autocomplete="city" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('city')" />
        </div> --}}

        {{-- Province --}}
        {{-- <div>
            <x-input-label for="province" :value="__('Province')" />
            <x-text-input id="province" name="province" type="text" class="tw-mt-1 tw-block
            tw-w-full" :value="old('province', $detail?->province)" required autofocus autocomplete="province" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('province')" />
        </div> --}}

        {{-- Country --}}
        {{-- <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="tw-mt-1 tw-block
            tw-w-full" :value="old('country', $detail?->country)" required autofocus autocomplete="country" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('country')" />
        </div> --}}

        {{-- Address --}}
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-textarea-input id="address" name="address" class="tw-mt-1 tw-block tw-w-full"
                :value="old('address', $detail?->address)" required autofocus autocomplete="address">{{
                $detail?->address }}</x-textarea-input>
            <x-input-error class="tw-mt-2" :messages="$errors->get('address')" />
        </div>

        {{-- Birth Date --}}
        <div>
            <x-input-label for="birth_date" :value="__('Birth Date')" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="tw-mt-1 tw-block
                tw-w-full" :value="old('birth_date', $detail?->birth_date)" required autofocus
                autocomplete="birth_date" />
            <x-input-error class="tw-mt-2" :messages="$errors->get('birth_date')" />
        </div>

        <div class="tw-flex tw-items-center tw-gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="tw-text-sm tw-text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>