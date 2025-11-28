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
                            <div class="card-media">
                                @if($event->imagem)
                                    <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}">
                                @else
                                    <div class="card-media-placeholder">
                                        <span>Sem imagem</span>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <h3 class="card-title">{{ $event->titulo }}</h3>

                                <div class="info-list">
                                    <div class="info-row">
                                        <span class="info-label">Data</span>
                                        <span class="info-value">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                                    </div>
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
