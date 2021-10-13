<x-guest-layout>
    <x-header></x-header>
    <x-auth-card>
        <x-slot name="logo">
            <div class="w-full sm:max-w-md px-6 py-4 bg-blue-600 shadow-md overflow-hidden sm:rounded-t-lg">
            <p class="text-white text-xl font-black w-full">Login</p>
        </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors 
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="flex">
                <img src="../logo/message.png" class="w-8 h-8 inline-block m-2">

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" />
            </div>
            @if($errors->has('email'))
                <p class="text-red-400 text-center mt-2.5">{{$errors->first('email')}}</p>
            @endif

            <!-- Password -->
            <div class="mt-4 flex">
                <img src="../logo/key.png" class="w-8 h-8 inline-block m-2">

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="Password"
                                autocomplete="current-password" />
            </div>
            @if($errors->has('password'))
            <p class="text-red-400 text-center mt-2.5">{{$errors->first('password')}}</p>
            @endif


            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
