<x-guest-layout>
    <x-header></x-header>
    
    <x-auth-card>
        <x-slot name="logo">
            <div class="w-full sm:max-w-md px-6 py-4 bg-blue-600 overflow-hidden sm:rounded-t-lg">
            <p class="text-white text-xl font-black w-full">Registration</p>
        </div>
        </x-slot>

        
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/thanks">
            @csrf
            <input type="hidden" name="role" value="customer">

            <!-- Name -->
            <div class="flex">
                
                <img src="../logo/assistance.png" class="w-8 h-8 inline-block m-2">
                

                <x-input id="name" class="inline-block mt-1 w-full" type="text" name="name" :value="old('name')"
                placeholder="Username"
                required autofocus/>
            </div>

            <!-- Email Address -->
            <div class="mt-4 flex">

                <img src="../logo/message.png" class="w-8 h-8 inline-block m-2">

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  placeholder="Email" required />
            </div>

            <!-- Password -->
            <div class="mt-4 flex">

            <img src="../logo/key.png" class="w-8 h-8 inline-block m-2">

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required autocomplete="new-password" />
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

