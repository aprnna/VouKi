<nav x-data="{ open: false }" class="tw-bg-tertiary3 tw-text-white tw-drop-shadow tw-z-50">
    <!-- Primary Navigation Menu -->
    <div class="tw-max-w-7xl tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
        <div class="tw-flex tw-justify-between tw-h-16 sm:tw-py-2">
            <div class="tw-flex">
                <!-- Logo -->
                <div class="tw-shrink-0 tw-flex tw-items-center">
                    <a href="{{ auth()->check() ? route('events.index') : route('home.index') }}"
                        class="flex tw-items-center tw-gap-2 hover:tw-opacity-80">
                        <x-application-logo class="tw-block tw-h-12 tw-w-auto tw-drop-shadow" />
                        <h1 class="tw-font-bold tw-text-xl">VouKi</h1>
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="tw-hidden tw-space-x-8 sm:tw--my-px sm:tw-ms-10 sm:tw-flex">
                <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                    {{ __('Events') }}
                </x-nav-link>
                <x-nav-link as="form" action="{{ route('events.nearest') }}" class="tw-group" method="GET"
                    :active="request()->routeIs('events.nearest')">
                    <input type="hidden" name="latitudeUser" id="latitudeUser">
                    <input type="hidden" name="longitudeUser" id="longitudeUser">
                    <button type="submit" class="h-full">
                        {{ __('Find Around Me') }}
                    </button>
                </x-nav-link>
                <x-nav-link :href="route('organizer.index')" :active="request()->routeIs('organizer.index')">
                    {{ __('Find Organizer') }}
                </x-nav-link>
                @can('isOrganizer')
                <x-nav-link :href="route('events.my')" :active="request()->routeIs('events.my')">
                    {{ __('My Events') }}
                </x-nav-link>
                @endcan
            </div>

            <!-- Settings Dropdown -->
            <div class="tw-hidden sm:tw-flex sm:tw-items-center sm:tw-ms-6 tw-z-50">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="tw-inline-flex tw-items-center tw-px-3 tw-py-2 tw-border tw-border-transparent tw-text-sm tw-leading-4 tw-font-medium tw-rounded-md tw-text-gray-500 tw-bg-white hover:tw-text-gray-700 focus:tw-outline-none tw-transition tw-ease-in-out tw-duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="tw-ms-1">
                                <svg class="tw-fill-current tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('events.my')">
                            @can('isOrganizer')
                            {{ __('My Events') }}
                            @endcan
                            @can('isVolunteer')
                            {{ __('Events History') }}
                            @endcan
                        </x-dropdown-link>
                        @can('isOrganizer')
                        <x-dropdown-link :href="route('events.create',['step'=>1])">
                            {{ __('Create Events') }}
                        </x-dropdown-link>
                        @endcan

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="tw-space-x-3">
                    <a href={{ route('login') }}>
                        <x-primary-button class="tw-bg-tertiary4 hover:tw-bg-tertiary1">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </a>
                    {{-- <a href={{ route('register') }}>
                        <x-secondary-button>
                            {{ __('Register') }}
                        </x-secondary-button>
                    </a> --}}
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="tw--me-2 tw-flex tw-items-center sm:tw-hidden">
                <button @click="open = ! open"
                    class="tw-inline-flex tw-items-center tw-justify-center tw-p-2 tw-rounded-md tw-text-white hover:tw-text-gray-500 hover:tw-bg-gray-100 focus:tw-outline-none focus:tw-bg-gray-100 focus:tw-text-gray-500 tw-transition tw-duration-150 tw-ease-in-out">
                    <svg class="tw-h-6 tw-w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'tw-hidden': open, 'tw-inline-flex': !open }" class="tw-inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'tw-hidden': !open, 'tw-inline-flex': open }" class="tw-hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'tw-block': open, 'tw-hidden': !open }" class="tw-hidden sm:tw-hidden">
        <div class="tw-pt-2 tw-pb-3 tw-space-y-1">
            <x-responsive-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                {{ __('Events') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link as="form" action="{{ route('events.nearest') }}" class="tw-group" method="GET"
                :active="request()->routeIs('events.nearest')">
                <input type="hidden" name="latitudeUser" id="latitudeUser">
                <input type="hidden" name="longitudeUser" id="longitudeUser">
                <button type="submit" class="h-full">
                    {{ __('Find Around Me') }}
                </button>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('organizer.index')" :active="request()->routeIs('organizer.index')">
                {{ __('Find Organizer') }}
            </x-responsive-nav-link>
            @can('isOrganizer')
            <x-responsive-nav-link :href="route('events.my')" :active="request()->routeIs('events.my')">
                {{ __('My Events') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="tw-pt-4 tw-pb-1 tw-border-t tw-border-gray-200">
            <div class="tw-px-4">
                <div class="tw-font-medium tw-text-base tw-text-white">{{ Auth::user()->name }}</div>
                <div class="tw-font-medium tw-text-sm tw-text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="tw-mt-3 tw-space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="tw-text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @can('isOrganizer')
                <x-responsive-nav-link :href="route('events.create', ['step'=>1])" class="tw-text-white">
                    {{ __('Create Event') }}
                </x-responsive-nav-link>
                @endcan
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();" class="tw-text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        @endauth

    </div>
</nav>