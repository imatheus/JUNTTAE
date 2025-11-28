<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="sr-only"/>
            <x-text-input id="email" class="input-custom w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="E-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <x-primary-button class="w-full py-3">
                {{ __('ENVIAR LINK DE REDEFINIÇÃO') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
