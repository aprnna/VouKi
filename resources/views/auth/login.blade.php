<x-guest-layout>

        {{-- Images --}}
        <x-slot name="image" imageClass="tw-bg-tertiary1">
            <div class="tw-bg-primary1 tw-w-[80%] tw-h-[90%] tw-absolute tw-top-0">
            </div>
            <img src="{{ asset('images/volunteer1.png') }}" alt="volunteer1.png" class="tw-right-0 tw-translate-x-8 tw-absolute">
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="tw-mb-4" :status="session('status')" />

        <h1 class="tw-text-lg tw-font-extrabold tw-mb-3">Sign In</h1>

        <form method="POST" action="{{ route('login') }}" class="tw-mb-3">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
            </div>

            <!-- Password -->
            <div class="tw-mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="tw-flex tw-items-center tw-mt-4 tw-justify-between">
                <label for="remember_me" class="tw-inline-flex tw-items-center">
                    <input id="remember_me" type="checkbox"
                        class="tw-rounded tw-border-gray-300 tw-text-indigo-600 tw-shadow-sm focus:tw-ring-indigo-500"
                        name="remember">
                    <span class="tw-ms-2 tw-text-sm tw-text-tertiary1">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                <a class="tw-underline tw-text-sm tw-text-tertiary1 tw-font-semibold hover:tw-text-secondary1 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>

            <x-primary-button class="tw-w-full tw-mt-5 tw-bg-tertiary1 flex tw-justify-center">
                {{ __('Sign In') }}
            </x-primary-button>
        </form>
        <div class="tw-mb-3 tw-flex tw-justify-center tw-w-full tw-items-center tw-gap-3">
            <hr class="tw-h-0.5 tw-border-t-0 tw-bg-gray-500/20 tw-flex-grow" />
            OR
            <hr class="tw-h-0.5 tw-border-t-0 tw-bg-gray-500/20 tw-flex-grow" />
        </div>
        <div class="tw-w-full tw-space-y-3 tw-mb-5">
            <a href={{ Route('google.redirect') }}>
                <x-primary-button class="tw-w-full tw-text-center tw-justify-center">
                    Sign in with Google
                </x-primary-button>
            </a>
        </div>
        <p class="tw-text-secondary1 tw-text-sm">Don’t have an account?<a href="{{ route('register') }}" class="tw-text-tertiary1 tw-ml-1 tw-underline tw-font-semibold">Sign Up</a></p>
</x-guest-layout>
