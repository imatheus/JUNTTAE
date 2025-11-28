<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem;">
            <h2 class="page-title">{{ $event->titulo }}</h2>
            <a href="{{ route('home') }}" class="link-primary">← Voltar aos Eventos</a>
        </div>
    </x-slot>

    <div style="max-width: 64rem; margin: 0 auto;">
        {{-- Alerts padronizados --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="card" style="overflow:hidden;">
            {{-- Hero / Banner do evento --}}
            <div class="hero-card">
                @if($event->imagem)
                    <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" class="hero-img">
                @else
                    <div class="card-media-placeholder" style="height: 360px;">
                        <span>Sem imagem</span>
                    </div>
                @endif

                <div class="hero-overlay">
                    <h1 class="hero-title" style="margin-bottom: 0.25rem;">{{ $event->titulo }}</h1>
                    <div class="hero-meta" style="gap: 0.5rem;">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="hero-meta" style="gap: 0.5rem;">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $event->local }}</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{-- Informações principais --}}
                <div class="form-grid columns-2" style="gap: 1rem; margin-bottom: 1.5rem;">
                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; align-items:center; gap: 0.75rem;">
                        <div style="width: 2rem; height: 2rem; border-radius: 0.5rem; background:#ede9fe; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#6d28d9" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight:700; color:#6b7280; text-transform: uppercase;">Categoria</div>
                            <div style="font-weight: 600; color:#111827;">{{ $event->categoria }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; align-items:center; gap: 0.75rem;">
                        <div style="width: 2rem; height: 2rem; border-radius: 0.5rem; background:#e0e7ff; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#4f46e5" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight:700; color:#6b7280; text-transform: uppercase;">Curador</div>
                            <div style="font-weight: 600; color:#111827;">{{ $event->curador->name }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; align-items:center; gap: 0.75rem;">
                        <div style="width: 2rem; height: 2rem; border-radius: 0.5rem; background:#10b981; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#ffffff" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight:700; color:#047857; text-transform: uppercase;">Valor do Ingresso</div>
                            <div class="price-value" style="font-size: 1.25rem;">R$ {{ number_format($event->valor, 2, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; align-items:center; gap: 0.75rem;">
                        <div style="width: 2rem; height: 2rem; border-radius: 0.5rem; background:#3b82f6; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="16" height="16" fill="none" stroke="#ffffff" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; font-weight:700; color:#1d4ed8; text-transform: uppercase;">Ingressos</div>
                            <div style="font-weight: 700; color: {{ $event->availableTickets() > 0 ? '#1d4ed8' : '#dc2626' }};">
                                {{ $event->availableTickets() }} de {{ $event->ingressos }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Descrição --}}
                <div class="card-base card-bordered" style="padding: 1rem; margin-bottom: 1.5rem;">
                    <div class="section-divider" style="display:flex; align-items:center; gap:0.5rem;">
                        <svg width="16" height="16" fill="none" stroke="#374151" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        <strong style="font-size:0.875rem; color:#374151; text-transform:uppercase;">Descrição</strong>
                    </div>
                    <div style="color:#374151; line-height:1.6; white-space:pre-line;">
                        {{ $event->descricao }}
                    </div>
                </div>

                {{-- Ações --}}
                @auth
                    @if($hasPurchased)
                        <div class="card-alert" style="margin-bottom: 1rem;">
                            <p style="font-size:0.875rem; font-weight:600; color:#166534;">Você já possui ingressos para este evento!</p>
                        </div>
                        <div class="form-row">
                            <a href="{{ route('client.my-tickets') }}" class="btn-primary btn-inline" style="flex:1; justify-content:center;">
                                <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                Ver Meus Ingressos
                            </a>
                            @if($event->whatsapp_group)
                                <a href="{{ route('client.whatsapp.join', $event->id) }}" class="btn-success btn-inline" style="flex:1; justify-content:center;">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                                    </svg>
                                    Grupo WhatsApp
                                </a>
                            @endif
                        </div>
                    @else
                        @if($event->hasAvailableTickets())
                            <a href="{{ route('client.purchase.form', $event->id) }}" class="btn-primary" style="display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                                <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Comprar Ingressos
                            </a>
                        @else
                            <div class="alert alert-error" style="text-align:center; margin:0;">Ingressos Esgotados</div>
                        @endif
                    @endif
                @else
                    @if($event->hasAvailableTickets())
                        <div class="card-alert" style="text-align:center; margin-bottom: 1rem;">
                            <p style="font-size:0.875rem; color:#374151;">Para comprar ingressos, você precisa estar logado.</p>
                        </div>
                        <div class="form-row">
                            <a href="{{ route('login') }}" class="btn-secondary" style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                                <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Entrar
                            </a>
                            <a href="{{ route('register') }}" class="btn-primary" style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                                <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Cadastrar
                            </a>
                        </div>
                    @else
                        <div class="alert alert-error" style="text-align:center; margin:0;">Ingressos Esgotados</div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
