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
                                
                                {{-- Overlay: categoria, título, data, local e preço abaixo do local --}}
                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.55) 65%, transparent 100%); padding: 1rem; color: white;">
                                    <div style="display:flex; align-items:center; justify-content:flex-start; gap:0.5rem; margin-bottom: 0.25rem;">
                                        <span class="badge badge-info" style="font-weight:700;">{{ $event->categoria }}</span>
                                    </div>
                                    <h3 class="overlay-title" style="margin:0 0 0.35rem 0; text-shadow: 0 2px 6px rgba(0,0,0,0.4);">
                                        {{ $event->titulo }}
                                    </h3>
                                    <div style="display: grid; gap: 0.3rem; font-size: 0.85rem;">
                                        <div style="display:flex; align-items:center; gap:0.4rem;">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div style="display:flex; align-items:center; gap:0.4rem;">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $event->local }}</span>
                                        </div>
                                        <div style="display:flex; align-items:center; gap:0.4rem; font-weight:800;">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="info-list">
                                    <div class="info-row">
                                        <div style="display:flex; align-items:center; gap:0.375rem;">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                            <span class="info-label">Ingressos restantes</span>
                                        </div>
                                        <span class="info-value">{{ $event->availableTickets() }}</span>
                                    </div>
                                </div>

                                @if(!empty($event->descricao))
                                    <div style="margin-top: 0.5rem; background: var(--color-gray-50); border: 1px solid var(--color-gray-200); border-radius: var(--radius-lg); padding: 0.75rem;">
                                        <p style="margin: 0; font-size: 0.875rem; color: #374151; line-height: 1.5;">
                                            {{ \Illuminate\Support\Str::limit($event->descricao, 140) }}
                                        </p>
                                    </div>
                                @endif

                                <a href="{{ route('client.event.show', $event->id) }}" class="btn-primary" style="margin-top: 0.75rem; border-radius: 9999px;">
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
