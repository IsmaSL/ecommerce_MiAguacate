<x-guest-layout>
    <x-jet-authentication-card>
        {{-- <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot> --}}

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            <x-slot name="logo">
                <a href="/">
                    <x-jet-authentication-card-logo />
                </a>
                
            </x-slot>
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-lg"/>
                <x-jet-input id="email" class="block mt-1 w-full text-lg" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" class="text-lg"/>
                <x-jet-input id="password" class="block mt-1 w-full text-lg" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="mx-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-6" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="">
                <x-jet-button class="w-full h-13 mt-6 text-lg">
                    <span class=" m-auto">
                        {{ __('Log in') }}
                    </span>
                </x-jet-button> 
                               
            </div>
        </form>
        <div class="flex justify-center">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-2" href="{{ route('register') }}">
                ??Quiero registrarme!
            </a>
        </div>
        
    </x-jet-authentication-card>
    
</x-guest-layout>
