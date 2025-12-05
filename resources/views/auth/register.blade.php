<x-guest-layout>
    <!-- Logo e Título -->
    <div class="auth-header">
        @if(file_exists(public_path('img/icone.png')))
            <img src="{{ asset('img/icone.png') }}" alt="Ícone" class="auth-logo">
        @endif
        <p class="auth-subtitle">Crie sua conta</p>
    </div>

    <!-- Formulário -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Nome e CPF/CNPJ -->
        <div class="form-grid columns-2">
            <div class="form-group">
                <x-input-label for="name" value="Nome" class="sr-only"/>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nome">
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="form-group">
                <x-input-label for="cpf_cnpj" value="CPF/CNPJ" class="sr-only"/>
                <input id="cpf_cnpj" type="text" name="cpf_cnpj" value="{{ old('cpf_cnpj') }}" autocomplete="cpf_cnpj" placeholder="CPF/CNPJ (Opcional)">
                <x-input-error :messages="$errors->get('cpf_cnpj')" />
            </div>
        </div>
        
        <!-- Email -->
        <div class="form-group">
            <x-input-label for="email" value="E-mail" class="sr-only"/>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="E-mail">
            <x-input-error :messages="$errors->get('email')" />
        </div>
        
        <!-- Senha -->
        <div class="form-group">
            <x-input-label for="password" value="Senha" class="sr-only"/>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Senha">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirmar Senha -->
        <div class="form-group">
            <x-input-label for="password_confirmation" value="Confirmar Senha" class="sr-only"/>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Tipo de Usuário -->
        <div class="form-group">
            <label for="tipo_usuario" style="display:block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tipo de Cadastro</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="curador" {{ old('tipo_usuario') == 'curador' ? 'selected' : '' }}>Cadastrar um evento (Curador)</option>
                <option value="usuario" {{ old('tipo_usuario') == 'usuario' ? 'selected' : '' }}>Apenas usuário</option>
            </select>
            <x-input-error :messages="$errors->get('tipo_usuario')" />
        </div>

        <!-- Botão Cadastrar -->
        <button type="submit" class="btn-primary">
            Cadastrar
        </button>

        <!-- Link para Login -->
        <div class="form-footer" style="justify-content: center;">
            <a href="{{ route('login') }}" class="link-primary" style="font-size: 0.875rem;">Já tenho cadastro!</a>
        </div>
    </form>
</x-guest-layout>
