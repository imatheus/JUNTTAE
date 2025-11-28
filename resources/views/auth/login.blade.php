<x-guest-layout>
    <!-- Logo e Título -->
    <div class="auth-header">
        @if(file_exists(public_path('img/logo.jpeg')))
            <img src="{{ asset('img/logo.jpeg') }}" alt="Junttaê Logo" class="auth-logo">
        @endif
        <h1 class="auth-title">JUNTTAÊ</h1>
        <p class="auth-subtitle">Entre na sua conta</p>
    </div>

    <!-- Status da Sessão -->
    <div class="form-group">
        <x-auth-session-status :status="session('status')" />
    </div>

    <!-- Formulário -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <x-input-label for="email" value="Email" class="sr-only"/>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="E-mail">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Senha -->
        <div class="form-group">
            <x-input-label for="password" value="Senha" class="sr-only"/>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Senha">
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Lembrar de mim -->
        <div class="form-row">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me" style="font-size: 0.875rem; color: #6b7280;">Lembrar de mim</label>
        </div>

        <!-- Botão Entrar -->
        <button type="submit" class="btn-primary">
            Entrar
        </button>

        <!-- Links -->
        <div class="form-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-primary" style="font-size: 0.875rem;">Esqueceu sua senha?</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="link-primary" style="font-size: 0.875rem;">Cadastrar-se</a>
            @endif
        </div>
    </form>
</x-guest-layout>
