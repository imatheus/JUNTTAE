<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Eventos Disponíveis</h2>
    </x-slot>

    <div>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif

            @if($events->isEmpty())
                <div class="card">
                    <div class="card-body text-center">
                        <p style="color:#6b7280; font-size: 1rem;">Nenhum evento disponível no momento.</p>
                    </div>
                </div>
            @else
                <div class="cards-grid">
                    @foreach($events as $event)
                        <div class="card">
                            <div class="card-media" style="position: relative; overflow: hidden;">
                                @if($event->imagem)
                                    <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="card-media-placeholder">
                                        <span>Sem imagem</span>
                                    </div>
                                @endif
                                
                                {{-- Overlay com título e data --}}
                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 70%, transparent 100%); padding: 1.5rem 1rem 1rem; color: white;">
                                    <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 0.5rem 0; line-height: 1.3; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                                        {{ $event->titulo }}
                                    </h3>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; opacity: 0.95;">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-list">
                                    <div class="info-row">
                                        <span class="info-label">Local</span>
                                        <span class="info-value">{{ $event->local }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Categoria</span>
                                        <span class="info-value">{{ $event->categoria }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Valor</span>
                                        <span class="info-value price-value">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Ingressos</span>
                                        <span class="info-value">{{ $event->availableTickets() }} de {{ $event->ingressos }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('client.event.show', $event->id) }}" class="btn-primary">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
