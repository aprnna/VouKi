<x-app-layout>
    @slot('title', 'Profile')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-container>
        <div class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg">
            <div class="tw-max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg">
            <div class="tw-max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg">
            <div class="tw-max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </x-container>
</x-app-layout>