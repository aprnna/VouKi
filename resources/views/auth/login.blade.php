<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="tw-mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <h3 class="text-red-500 font-bold text-xl pt-3 pb-3">
                Sign In
            </h3>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-red-500" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-red-500" />

            <x-text-input id="password" class="tw-block tw-mt-1 tw-w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="tw-mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex flex-row mt-4 justify-between">
            <div class="flex flex-1/2">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-red-500 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-red-500 font-semibold">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex flex-auto">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-red-500 font-semibold hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            </div>
        </div>

        <div class="flex flex-row">
            <div class="flex-1 mt-4">
                <x-primary-button class="flex w-full justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
        
    </form>
    <div class="w-full space-y-3 mb-2 mt-3">
        <a href={{ Route('google.redirect') }}>
            <x-secondary-button class="tw-w-full tw-text-center tw-justify-center">
                Sign in with Google
            </x-secondary-button>
        </a>
    </div>

    <div class="flex flex-row">
        <div class="flex-1 mt-4">
            <p class="text-sm text-red-500">Don't have an account? <a class="underline text-sm font-semibold hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href=>Sign Up</a>
        </div>
    </div>
</x-guest-layout>
