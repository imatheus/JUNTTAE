<x-guest-layout>
    <!-- Logo e Título -->
    <div class="text-center mb-6">
        @if(file_exists(public_path('img/logo.jpeg')))
            <img src="{{ asset('img/logo.jpeg') }}" alt="Junttaê Logo" class="w-16 h-16 mx-auto mb-3 rounded-full object-cover">
        @endif
        <h1 class="text-2xl font-bold text-gray-900">JUNTTAÊ</h1>
        <p class="text-xs text-gray-500 mt-1">Crie sua conta</p>
    </div>

    <!-- Formulário -->
    <form method="POST" action="{{ route('register') }}" class="space-y-3">
        @csrf
        
        <!-- Nome e CPF/CNPJ -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" value="Nome" class="sr-only"/>
                <input id="name" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Nome"
                       class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="cpf_cnpj" value="CPF/CNPJ" class="sr-only"/>
                <input id="cpf_cnpj" 
                       type="text" 
                       name="cpf_cnpj" 
                       value="{{ old('cpf_cnpj') }}" 
                       autocomplete="cpf_cnpj"
                       placeholder="CPF/CNPJ (Opcional)"
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <x-input-error :messages="$errors->get('cpf_cnpj')" class="mt-2" />
            </div>
        </div>
        
        <!-- Email -->
        <div>
            <x-input-label for="email" value="E-mail" class="sr-only"/>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="E-mail"
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <!-- Senha -->
        <div>
            <x-input-label for="password" value="Senha" class="sr-only"/>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="Senha"
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmar Senha" class="sr-only"/>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Confirmar Senha"
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tipo de Usuário -->
        <div>
            <label for="tipo_usuario" class="block text-sm font-medium text-gray-700 mb-2">
                Tipo de Cadastro
            </label>
            <select id="tipo_usuario" 
                    name="tipo_usuario" 
                    required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option value="curador" {{ old('tipo_usuario') == 'curador' ? 'selected' : '' }}>
                    Cadastrar um evento (Curador)
                </option>
                <option value="usuario" {{ old('tipo_usuario') == 'usuario' ? 'selected' : '' }}>
                    Apenas usuário
                </option>
            </select>
            <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
        </div>

        <!-- Botão Cadastrar -->
        <button type="submit" class="btn-primary">
            Cadastrar
        </button>

        <!-- Link para Login -->
        <div class="text-center pt-3 border-t border-gray-100">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-700 transition-colors">
                Já tenho cadastro!
            </a>
        </div>
    </form>
</x-guest-layout>
