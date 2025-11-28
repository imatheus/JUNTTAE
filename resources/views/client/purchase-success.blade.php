<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem;">
            <h2 class="page-title">Compra Realizada com Sucesso!</h2>
            <a href="{{ route('home') }}" class="link-primary">← Ver Eventos</a>
        </div>
    </x-slot>

    <div style="max-width: 48rem; margin: 0 auto;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="ticket ticket--success">
            <div class="ticket__header">
                <div class="ticket__icon">
                    <svg width="28" height="28" fill="none" stroke="#16a34a" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <div class="ticket__title">Compra Confirmada!</div>
                    <div class="ticket__subtitle">Seus ingressos foram reservados com sucesso</div>
                </div>
            </div>

            <div class="ticket__body">
                <div class="ticket__grid">
                    <div class="ticket__section">
                        <div class="info-list">
                            <div class="info-row">
                                <span class="info-label">Código da Compra</span>
                                <span class="info-value" style="font-family:monospace; font-weight:700;">{{ $purchase->codigo_compra }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Evento</span>
                                <span class="info-value">{{ $purchase->event->titulo }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Data</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Local</span>
                                <span class="info-value">{{ $purchase->event->local }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="ticket__section">
                        <div class="info-list">
                            <div class="info-row">
                                <span class="info-label">Quantidade</span>
                                <span class="info-value">{{ $purchase->quantidade }} {{ $purchase->quantidade == 1 ? 'ingresso' : 'ingressos' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Valor Unitário</span>
                                <span class="info-value">R$ {{ number_format($purchase->event->valor, 2, ',', '.') }}</span>
                            </div>
                            <div class="ticket__perforation">
                                <span class="ticket__hole ticket__hole--left"></span>
                                <span class="ticket__hole ticket__hole--right"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label" style="font-size:1rem;">Valor Total</span>
                                <span class="info-value price-value" style="font-size:1.5rem;">R$ {{ number_format($purchase->valor_total, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($purchase->event->whatsapp_group)
                    <div class="ticket__section" style="margin-top: 1rem;">
                        <div style="display:flex; align-items:flex-start; gap:0.75rem;">
                            <div style="width:2rem; height:2rem; border-radius:0.5rem; background:#d1fae5; display:flex; align-items:center; justify-content:center;">
                                <svg width="16" height="16" fill="#16a34a" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884" />
                                </svg>
                            </div>
                            <div style="flex:1;">
                                <div style="font-weight:700; color:#111827; margin-bottom:0.25rem;">Grupo do WhatsApp</div>
                                <p style="color:#374151; margin:0 0 0.5rem 0;">Entre no grupo para receber novidades e instruções do evento.</p>
                                <a href="{{ route('client.whatsapp.join', $purchase->event->id) }}" class="btn-success" style="width:100%;">Entrar no Grupo WhatsApp</a>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="ticket__section" style="margin-top: 1rem;">
                    <div style="font-weight:700; color:#111827; margin-bottom:0.5rem;">Informações Importantes</div>
                    <ul style="margin:0; padding-left:1.25rem; color:#374151;">
                        <li>Guarde o código da compra: <strong>{{ $purchase->codigo_compra }}</strong></li>
                        <li>Visualize seus ingressos em "Meus Ingressos"</li>
                        <li>Apresente este código no dia do evento</li>
                        <li>Em caso de dúvidas, contate o curador do evento</li>
                    </ul>
                </div>
            </div>

            <div class="ticket__footer">
                <a href="{{ route('home') }}" class="btn-secondary" style="flex:1;">Ver Outros Eventos</a>
                <a href="{{ route('client.my-tickets') }}" class="btn-primary" style="flex:1;">Meus Ingressos</a>
            </div>
        </div>
    </div>
</x-app-layout>
