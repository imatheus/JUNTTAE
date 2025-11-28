<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem;">
            <h2 class="page-title">Meus Ingressos</h2>
            <a href="{{ route('home') }}" class="link-primary">← Voltar aos Eventos</a>
        </div>
    </x-slot>

    <div>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if($purchases->isEmpty())
                <div class="card">
                    <div class="card-body text-center">
                        <p style="color:#6b7280; font-size: 1rem;">Você ainda não possui ingressos.</p>
                        <div style="margin-top: 1rem;">
                            <a href="{{ route('home') }}" class="btn-primary btn-inline">Ver Eventos Disponíveis</a>
                        </div>
                    </div>
                </div>
            @else
                <div style="display:flex; flex-direction:column; gap: 1.25rem;">
                    @foreach($purchases as $purchase)
                        <div class="card" style="overflow:hidden;">
                            <div class="card-body" style="display:flex; flex-direction:column; gap:0.75rem;">
                                <!-- Banner / Imagem (Topo) -->
                                <div style="position: relative; width: 100%; height: 220px; border-radius: 0.75rem; overflow: hidden;">
                                    @if($purchase->event->imagem)
                                        <img src="{{ asset('storage/' . $purchase->event->imagem) }}" alt="{{ $purchase->event->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div class="card-media-placeholder" style="height: 100%;"><span>Sem imagem</span></div>
                                    @endif

                                    <!-- Quantidade no canto direito do banner -->
                                    <span style="position:absolute; top: 0.5rem; right: 0.5rem; background: rgba(0,0,0,0.55); color:#fff; font-weight:700; font-size:0.8rem; padding: 0.3rem 0.6rem; border-radius: 999px;">
                                        {{ $purchase->quantidade }} {{ $purchase->quantidade == 1 ? 'ingresso' : 'ingressos' }}
                                    </span>

                                    <!-- Overlay inferior -->
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.55) 70%, transparent 100%); padding: 0.75rem 0.75rem 0.9rem; color: white;">
                                        <!-- Título -->
                                        <h3 style="margin:0 0 0.25rem 0; font-size: 1.1rem; font-weight: 800; text-shadow: 0 2px 6px rgba(0,0,0,0.4);">
                                            {{ $purchase->event->titulo }}
                                        </h3>
                                        <!-- Badge Confirmado -->
                                        <span class="badge badge-success" style="background: rgba(22, 163, 74, 0.9); color: #ffffff; border-radius: 999px; padding: 0.25rem 0.5rem; font-weight: 700; font-size: 0.75rem; display:inline-flex; margin-bottom: 0.35rem;">Confirmado</span>

                                        <!-- Data -->
                                        <div style="display:flex; align-items:center; gap: 0.4rem; font-size: 0.85rem;">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span style="font-weight: 600;">{{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y \\à\\s H:i') }}</span>
                                        </div>
                                        <!-- Local -->
                                        <div style="display:flex; align-items:center; gap:0.4rem; font-size: 0.85rem; margin-top: 0.25rem;">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span style="font-weight: 600;">{{ $purchase->event->local }}</span>
                                        </div>
                                        <!-- Preço (sem label) -->
                                        <div style="display:flex; align-items:center; gap:0.4rem; font-weight:800; font-size: 1rem; margin-top: 0.3rem;">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>R$ {{ number_format($purchase->valor_total, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Código (linha simples, sem bg cinza) -->
                                <div style="display:flex; align-items:center; justify-content:space-between; padding-top: 0.25rem;">
                                    <div style="font-size:0.75rem; font-weight:600; color:#6b7280; text-transform:uppercase;">Código</div>
                                    <div style="font-family:monospace; font-weight:700; color:#111827;">{{ $purchase->codigo_compra }}</div>
                                </div>

                                <!-- Ações (empilhadas) -->
                                <div style="width: 100%;">
                                    <div class="button-group-vertical">
                                        @if($purchase->event->whatsapp_group)
                                            <a href="{{ route('client.whatsapp.join', $purchase->event->id) }}" class="btn-success">Grupo WhatsApp</a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Lembrete -->
                                <div style="width:100%; padding: 0.75rem; background:#fffbeb; border-left:4px solid #f59e0b; border-radius: 0.5rem;">
                                    <p style="font-size:0.875rem; color:#92400e; margin:0;">
                                        <strong>Lembre-se:</strong> Apresente o código <strong>{{ $purchase->codigo_compra }}</strong> no dia do evento.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
