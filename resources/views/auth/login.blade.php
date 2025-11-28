<x-guest-layout>
    <!-- Logo e Título -->
    <div class="text-center mb-6">
        @if(file_exists(public_path('img/logo.jpeg')))
            <img src="{{ asset('img/logo.jpeg') }}" alt="Junttaê Logo" class="w-16 h-16 mx-auto mb-3 rounded-full object-cover">
        @endif
        <h1 class="text-2xl font-bold text-gray-900">JUNTTAÊ</h1>
        <p class="text-xs text-gray-500 mt-1">Entre na sua conta</p>
    </div>

    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Formulário -->
    <form method="POST" action="{{ route('login') }}" class="space-y-3">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" class="sr-only"/>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="E-mail"
                   class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div>
            <x-input-label for="password" value="Senha" class="sr-only"/>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Senha"
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembrar de mim -->
        <div class="flex items-center">
            <input id="remember_me" 
                   type="checkbox" 
                   name="remember"
                   class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-200 rounded focus:ring-2 focus:ring-blue-500">
            <label for="remember_me" class="ml-2 text-sm text-gray-600">
                Lembrar de mim
            </label>
        </div>

        <!-- Botão Entrar -->
        <button type="submit" class="btn-primary">
            Entrar
        </button>

        <!-- Links -->
        <div class="flex justify-between items-center pt-3 border-t border-gray-100">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 transition-colors">
                    Esqueceu sua senha?
                </a>
            @endif
            
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-700 transition-colors">
                    Cadastrar-se
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
