<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img
                class="rounded-lg border-2 border-espresso bg-coffee-brown"
                src="https://kopiiiiiimg.netlify.app/assets/images/kopii-squared.png"
                alt="Kopii Logo"
            >
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="font-archivo">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-start mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-coffee-brown hover:text-espresso rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-espresso" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <span class="text-sm mx-3 text-coffee-brown"> or </span>
                <a href="{{ route('register') }}" class="underline text-coffee-brown text-sm hover:text-espresso rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-espresso">register here</a>
                <x-button class="block ms-auto">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
