<nav x-data="{ open: false }" class="navbar">
    <div class="container">
        <div class="navbar-inner">
            <div class="navbar-left">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a href="{{ route('home') }}">
                        @if(file_exists(public_path('img/logo.jpeg')))
                            <img src="{{ asset('img/logo.jpeg') }}" alt="JUNTTAÊ" class="logo">
                        @else
                            <x-application-logo class="logo" />
                        @endif
                    </a>
                </div>

                <!-- Navigation Links moved to right -->
            </div>

            <!-- Settings Dropdown / Login Buttons -->
            <div class="navbar-right">
                <div class="navbar-links">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Eventos') }}
                    </x-nav-link>
                    
                    <div class="navbar-auth">
                @auth
                        @if(Auth::user()->tipo_usuario === 'curador')
                            <x-nav-link :href="route('curador.dashboard')" :active="request()->routeIs('curador.dashboard')">
                                {{ __('Meus Eventos') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('client.my-tickets')" :active="request()->routeIs('client.my-tickets')">
                                {{ __('Meus Ingressos') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
                </div>
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="btn-inline" style="border: 1px solid transparent; padding: 0.5rem 0.75rem; border-radius: 0.5rem; background: #fff; color: #6b7280; font-weight: 500;">
                                <div>{{ Auth::user()->name }}</div>
                                <div style="margin-left: 0.25rem;">
                                    <svg class="" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill="currentColor" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('login') }}" class="btn-secondary btn-inline">
                            Entrar
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary btn-inline">
                            Cadastrar
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="" style="display: flex; align-items: center;">
                <button @click="open = ! open" class="hamburger" aria-label="Abrir Menu">
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'is-open': open}" class="mobile-menu">
        <div class="mobile-menu-inner">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Eventos') }}
            </x-responsive-nav-link>
            
            @auth
                @if(Auth::user()->tipo_usuario === 'curador')
                    <x-responsive-nav-link :href="route('curador.dashboard')" :active="request()->routeIs('curador.dashboard')">
                        {{ __('Meus Eventos') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('client.my-tickets')" :active="request()->routeIs('client.my-tickets')">
                        {{ __('Meus Ingressos') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <!-- Responsive Settings Options -->
            @auth
                <div style="padding-top: 0.75rem; padding-bottom: 0.75rem; border-top: 1px solid var(--color-gray-200);">
                    <div style="padding: 0 1rem;">
                        <div style="font-weight: 600; font-size: 1rem; color: #1f2937;">{{ Auth::user()->name }}</div>
                        <div style="font-weight: 500; font-size: 0.875rem; color: #6b7280;">{{ Auth::user()->email }}</div>
                    </div>

                    <div style="margin-top: 0.75rem; display: grid; gap: 0.25rem;">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <div style="padding-top: 0.75rem; padding-bottom: 0.75rem; border-top: 1px solid var(--color-gray-200);">
                    <div style="padding: 0 1rem; display: grid; gap: 0.5rem;">
                        <x-responsive-nav-link :href="route('login')">
                            {{ __('Entrar') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Cadastrar') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
