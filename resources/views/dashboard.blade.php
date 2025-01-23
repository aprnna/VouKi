<x-app-layout>
    @slot('title','Dashboard')
    <x-slot name="header">
        <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container class="tw-max-w-7xl tw-mx-auto tw-sm:px-6 tw-lg:px-8">
        <div class="tw-bg-white tw-overflow-hidden tw-shadow-sm tw-sm:rounded-lg">
            <div class="tw-p-6 tw-text-gray-900">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </x-container>
</x-app-layout>