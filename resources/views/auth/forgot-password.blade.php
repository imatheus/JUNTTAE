<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="sr-only"/>
            
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus
                placeholder="E-mail"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full py-3 justify-center text-lg font-semibold border-none"
                style="background-color: #00A79E; color: white; border-radius: 9999px;">
                {{ __('ENVIAR LINK DE REDEFINIÇÃO') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>