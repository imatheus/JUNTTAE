<x-guest-layout>
    <div class="mb-10 flex flex-col items-center">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Junttaê Logo" class="w-20 h-20 rounded-full mb-2">
        <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-200 tracking-wider">JUNTTAÊ</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div>
                <x-input-label for="name" :value="__('Nome')" class="sr-only"/>
                <x-text-input id="name" class="block w-full"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nome"
                    style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="cpf_cnpj" :value="__('CPF/CNPJ')" class="sr-only"/>
                <x-text-input id="cpf_cnpj" class="block w-full"
                    type="text" name="cpf_cnpj" :value="old('cpf_cnpj')" autocomplete="cpf_cnpj" placeholder="CPF/CNPJ (Opcional)"
                    style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
                <x-input-error :messages="$errors->get('cpf_cnpj')" class="mt-2" />
            </div>
        </div>
        
        <div class="mb-4">
            <x-input-label for="email" :value="__('E-mail')" class="sr-only"/>
            <x-text-input id="email" class="block w-full"
                type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="E-mail"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="mb-4">
            <x-input-label for="password" :value="__('Senha')" class="sr-only"/>
            <x-text-input id="password" class="block w-full"
                type="password" name="password" required autocomplete="new-password" placeholder="Senha"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="sr-only"/>
            <x-text-input id="password_confirmation" class="block w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha"
                style="background-color: #f3e5f5; border: none; padding: 1.5rem 1rem; border-radius: 0.5rem;" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-6">
            <x-input-label for="tipo_usuario" :value="__('Tipo de Cadastro')" class="text-gray-700 dark:text-gray-300 mb-2 font-medium"/>
            
            <select id="tipo_usuario" name="tipo_usuario" 
                class="block w-full shadow-sm rounded-md" 
                required
                style="background-color: #f3e5f5; border: none; padding: 1rem 1rem;">
                <option value="curador" {{ old('tipo_usuario') == 'curador' ? 'selected' : '' }}>Cadastrar um evento (Curador)</option>
                <option value="usuario" {{ old('tipo_usuario') == 'usuario' ? 'selected' : '' }}>Apenas usuário</option>
            </select>
            <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
        </div>


        <div class="flex flex-col items-center mt-8 space-y-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium transition duration-150 ease-in-out" 
               href="{{ route('login') }}">
                {{ __('Já tenho cadastro!') }}
            </a>

            <x-primary-button class="w-full py-3 justify-center text-lg font-bold border-none"
                style="background-color: #00A79E; color: white; border-radius: 9999px;">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>