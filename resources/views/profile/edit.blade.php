<x-app-layout>
    @slot('title', 'Profile')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-container>
        <div x-data="{ tab: 'profile-information' }" class="tw-flex tw-space-x-4">
            <!-- Navigation Column -->
            <div class="tw-w-1/4 tw-bg-red-100 tw-p-4 tw-shadow sm:tw-rounded-lg tw-h-auto">
                <div class="tw-flex tw-flex-col tw-space-y-4">
                    <button @click.prevent="tab = 'profile-information'" :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'profile-information', 'tw-bg-white tw-text-red-950': tab !== 'profile-information' }" class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors">
                        Profile Information
                    </button>
                    <button @click.prevent="tab = 'update-password'" :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'update-password', 'tw-bg-white tw-text-red-950': tab !== 'update-password' }" class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors">
                        Update Password
                    </button>
                    <button @click.prevent="tab = 'delete-user'" :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'delete-user', 'tw-bg-white tw-text-red-950': tab !== 'delete-user' }" class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors">
                        Delete Account
                    </button>
                </div>
            </div>

            <!-- Content Column -->
            <div class="tw-w-3/4">
            <div x-show="tab === 'profile-information'" class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg">
                <div class="tw-max-w-xl">
                @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div x-show="tab === 'update-password'" class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg tw-mt-4">
                <div class="tw-max-w-xl">
                @include('profile.partials.update-password-form')
                </div>
            </div>

            <div x-show="tab === 'delete-user'" class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg tw-mt-4">
                <div class="tw-max-w-xl">
                @include('profile.partials.delete-user-form')
                </div>
            </div>
            </div>
        </div>
    </x-container>
</x-app-layout>