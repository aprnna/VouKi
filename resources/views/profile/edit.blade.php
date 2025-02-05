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
                    <button @click.prevent="tab = 'profile-information'"
                        :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'profile-information', 'tw-bg-white tw-text-red-950': tab !== 'profile-information' }"
                        class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors tw-flex tw-items-center">
                        <svg class="tw-w-5 tw-h-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A9 9 0 1117.804 5.121 9 9 0 015.121 17.804z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v5l3 3">
                            </path>
                        </svg>
                        Profile Information
                    </button>
                    <button @click.prevent="tab = 'update-password'"
                        :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'update-password', 'tw-bg-white tw-text-red-950': tab !== 'update-password' }"
                        class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors tw-flex tw-items-center">
                        <svg class="tw-w-5 tw-h-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3 1.343 3 3 3 3-1.343 3-3z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11V7m0 0a5 5 0 00-5-5h0a5 5 0 00-5 5v4m10 0v4m0 0a5 5 0 005 5h0a5 5 0 005-5v-4m-10 0h10">
                            </path>
                        </svg>
                        Update Password
                    </button>
                    <button @click.prevent="tab = 'delete-user'"
                        :class="{ 'tw-bg-rose-950 tw-text-white': tab === 'delete-user', 'tw-bg-white tw-text-red-950': tab !== 'delete-user' }"
                        class="tw-py-2 tw-px-4 tw-rounded tw-border tw-text-red-950 tw-transition-colors tw-flex tw-items-center">
                        <svg class="tw-w-5 tw-h-5 tw-mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Delete Account
                    </button>
                </div>
            </div>

            <!-- Content Column -->
            <div class="tw-w-3/4">
                <div x-show="tab === 'profile-information'" x-transition
                    class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg">
                    <div class="tw-max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div x-show="tab === 'update-password'" x-transition
                    class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg tw-mt-4">
                    <div class="tw-max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div x-show="tab === 'delete-user'" x-transition
                    class="tw-p-4 sm:tw-p-8 tw-bg-white tw-shadow sm:tw-rounded-lg tw-mt-4">
                    <div class="tw-max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </x-container>

</x-app-layout>