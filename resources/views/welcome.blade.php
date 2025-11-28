<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="page-wrapper">
            <main class="page-content">
                <div class="container section">
                    @if (Route::has('login'))
                        <nav style="display:flex; justify-content:flex-end; gap: 1rem; margin-bottom: 1.5rem;">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary btn-inline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary btn-inline">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary btn-inline">Register</a>
                                @endif
                            @endauth
                        </nav>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem;">Bem-vindo ao {{ config('app.name', 'Laravel') }}</h1>
                            <p style="color: #4b5563; margin-bottom: 1rem;">
                                Laravel tem um ecossistema incrivelmente rico. Sugerimos começar com o seguinte:
                            </p>
                            
                            <ul style="display: grid; gap: 0.75rem; margin-bottom: 1.5rem;">
                                <li>
                                    <a href="https://laravel.com/docs" target="_blank" class="link-primary">
                                        📚 Leia a Documentação
                                    </a>
                                </li>
                                <li>
                                    <a href="https://laracasts.com" target="_blank" class="link-primary">
                                        🎥 Assista tutoriais em vídeo no Laracasts
                                    </a>
                                </li>
                            </ul>

                            <a href="https://cloud.laravel.com" target="_blank" class="btn-primary btn-inline">
                                Deploy agora
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
