<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="tw-mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <h3 class="tw-text-red-950 tw-font-bold tw-text-xl tw-pt-3 tw-pb-3">
                Sign In
            </h3>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="tw-text-red-950" />
            <x-text-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="tw-mt-2" />
        </div>

        <!-- Password -->
        <div class="tw-mt-4">
            <x-input-label for="password" :value="__('Password')" class="tw-text-red-950" />

            <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="tw-flex tw-flex-row tw-mt-4 tw-justify-between">
            <div class="tw-flex tw-items-center">
            <label for="remember_me" class="tw-inline-flex tw-items-center">
                <input id="remember_me" type="checkbox"
                class="tw-rounded tw-border-gray-300 tw-text-red-950 tw-shadow-sm focus:tw-ring-indigo-500" name="remember">
                <span class="tw-ms-2 tw-text-sm tw-text-red-950 tw-font-semibold">{{ __('Remember me') }}</span>
            </label>
            </div>
            <div class="tw-flex tw-items-center">
            @if (Route::has('password.request'))
            <a class="tw-underline tw-text-sm tw-text-red-950 tw-font-semibold hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
            </div>
        </div>

        <div class="tw-flex tw-flex-row">
            <div class="tw-flex-1 tw-mt-4">
                <x-primary-button class="tw-flex tw-w-full tw-justify-center tw-bg-rose-950">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
        
    </form>
    <div class="tw-w-full tw-space-y-3 tw-mb-2 tw-mt-3">
        <a href={{ Route('google.redirect') }}>
            <x-secondary-button class="tw-w-full tw-text-center tw-justify-center">
                Sign in with Google
            </x-secondary-button>
        </a>
    </div>

    <div class="tw-flex tw-flex-row">
        <div class="tw-flex-1 tw-mt-4">
            <p class="tw-text-sm tw-text-red-950">Don't have an account? <a class="tw-underline tw-text-sm tw-font-semibold hover:tw-text-gray-900 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500" href=>Sign Up</a>
        </div>
    </div>
</x-guest-layout>
