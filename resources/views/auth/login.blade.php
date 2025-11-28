

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <!-- LOGO JUNTTAÊ -->
    <div class="mb-8 flex flex-col items-center">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Junttaê Logo" class="w-20 h-20 rounded-full mb-2">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">JUNTTAÊ</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="sr-only"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="E-mail"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="sr-only"/>
            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" 
                placeholder="Senha"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center mt-8">
            <!-- Botão de Login com estilização Verde-Água/Ciano, W-FULL -->
            <x-primary-button class="w-full py-3 justify-center text-lg font-semibold border-none"
                style="background-color: #00A79E; color: white; border-radius: 9999px;">
                {{ __('Entrar') }}
            </x-primary-button>
            
            <!-- Link de Esqueceu a Senha e Cadastro -->
            <div class="flex justify-between w-full mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif
                
                @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                        {{ __('Cadastrar-se') }}
                    </a>
                @endif
            </div>
            
        </div>
    </form>
</x-guest-layout>