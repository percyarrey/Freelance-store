<x-guest-layout>
    <x-authentication-card>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between w-full mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                

                <x-button class="ml-4 ">
                    {{ __('Log in') }}
                </x-button>
                
            </div>
            <div class="flex items-center justify-end mt-4">
                
                    <a class="text-cyan-700 font-bold ml-4 mr-4 items-center px-4 py-2 border rounded-md text-xs bg-white uppercase tracking-widest focus:outline-black focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full hover:outline-cyan-500 hover:outline-1 flex justify-between h-8 mr-3']" href="{{url('auth/google')}}">
                        <div>
                            <i class="fab fa-google text-red-600"></i>
                        </div>
                        <div class=' w-8/12'>Login with Google</div>
                    </a>
            </div>
            <div class="mt-4">Don't have an Account? <a href="/register" class=" text-sky-800 underline">Sign Up</a></div>
        </form>
    </x-authentication-card>
</x-guest-layout>
