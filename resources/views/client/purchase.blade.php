<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.75rem;">
            <h2 class="page-title">Comprar Ingressos</h2>
            <a href="{{ route('client.event.show', $event->id) }}" class="link-primary">← Voltar ao Evento</a>
        </div>
    </x-slot>

    <div class="purchase-page" style="max-width: 56rem; margin: 0 auto;">
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="card purchase-card">
            <div class="card-body">
                {{-- Detalhes do Evento --}}
                <div class="section-divider" style="display:flex; align-items:center; justify-content:space-between;">
                    <div>
                        <div style="font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:700;">Evento</div>
                        <div class="card-title" style="margin:0;">{{ $event->titulo }}</div>
                    </div>
                </div>

                <div class="form-grid columns-2" style="gap: 1rem; margin-bottom: 1.5rem;">
                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; gap:0.75rem; align-items:flex-start;">
                        <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:#dbeafe; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="18" height="18" fill="none" stroke="#2563eb" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:700;">Data e Hora</div>
                            <div style="font-weight:600; color:#111827;">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; gap:0.75rem; align-items:flex-start;">
                        <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:#dcfce7; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="18" height="18" fill="none" stroke="#16a34a" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:0.75rem; color:#6b7280; text-transform:uppercase; font-weight:700;">Local</div>
                            <div style="font-weight:600; color:#111827;">{{ $event->local }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; gap:0.75rem; align-items:flex-start;">
                        <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:#10b981; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="18" height="18" fill="none" stroke="#ffffff" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:0.75rem; color:#047857; text-transform:uppercase; font-weight:700;">Valor Unitário</div>
                            <div class="price-value" style="font-size:1.25rem;">R$ {{ number_format($event->valor, 2, ',', '.') }}</div>
                        </div>
                    </div>

                    <div class="card-base card-bordered" style="padding: 1rem; display:flex; gap:0.75rem; align-items:flex-start;">
                        <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:#bfdbfe; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="18" height="18" fill="none" stroke="#1d4ed8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div>
                            <div style="font-size:0.75rem; color:#1d4ed8; text-transform:uppercase; font-weight:700;">Disponíveis</div>
                            <div style="font-weight:700; color:#1f2937;">{{ $event->availableTickets() }}</div>
                        </div>
                    </div>
                </div>

                {{-- Quantidade --}}
                <div class="section-divider">
                    <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.75rem;">
                        <svg width="16" height="16" fill="none" stroke="#4f46e5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <strong style="font-size:0.875rem; color:#374151; text-transform:uppercase;">Quantidade de Ingressos</strong>
                    </div>

                    <div class="form-row" style="align-items:center;">
                        <button type="button" onclick="decrementQuantity()" class="btn-secondary btn-inline" style="width:3rem; height:3rem; padding:0;">
                            <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>

                        <input type="number" name="quantidade" id="quantidade" min="1" max="{{ min(10, $event->availableTickets()) }}" value="1" class="input-field" style="text-align:center; font-size:1.25rem; font-weight:700; width: 8rem;" onchange="updateTotal()" readonly>

                        <button type="button" onclick="incrementQuantity()" class="btn-secondary btn-inline" style="width:3rem; height:3rem; padding:0;">
                            <svg width="18" height="18" fill="none" stroke="#1f2937" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                    <p class="mt-2" style="font-size:0.875rem; color:#6b7280; text-align:center;">Máximo de <strong style="color:#374151;">{{ min(10, $event->availableTickets()) }}</strong> ingressos por compra</p>
                </div>

                {{-- Valor Total --}}
                <div class="card-base card-bordered" style="padding:1rem; margin: 1rem 0 1.5rem 0; background: linear-gradient(90deg, #f9fafb, #f3f4f6);">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <div>
                            <div style="font-size:0.875rem; color:#6b7280; font-weight:600;">Valor Total</div>
                            <div id="valorTotal" style="font-size:2rem; font-weight:800; color:#1f2937;">R$ {{ number_format($event->valor, 2, ',', '.') }}</div>
                        </div>
                        <div style="width:3.5rem; height:3.5rem; border-radius:50%; background:#e5e7eb; display:flex; align-items:center; justify-content:center;">
                            <svg width="24" height="24" fill="none" stroke="#374151" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Ações --}}
                <div class="button-group">
                    <a href="{{ route('client.event.show', $event->id) }}" class="btn-secondary" style="flex:1; display:flex; align-items:center; justify-content:center;">
                        Cancelar
                    </a>
                    <button type="button" id="btnAbrirModal" class="btn-primary" style="flex:1; display:flex; align-items:center; justify-content:center;">
                        Continuar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Pagamento PIX -->
    <div id="pixModal" style="display:none; position:fixed; inset:0; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; padding: 1rem; align-items: center; justify-content: center;">
        <div class="card-base card-bordered" style="background: white; border-radius: 1rem; max-width: 42rem; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);" onclick="event.stopPropagation()">
            
            <!-- Header do Modal -->
            <div class="section-divider" style="position: sticky; top: 0; background: white; padding: 1rem 1.5rem; border-radius: 1rem 1rem 0 0; z-index: 10; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <div style="width:2.5rem; height:2.5rem; background:#e0e7ff; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                        <svg width="20" height="20" fill="none" stroke="#4f46e5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1.25rem; font-weight:700; color:#111827; margin:0;">Pagamento via PIX</h3>
                        <p style="font-size:0.875rem; color:#6b7280; margin:0;">Escaneie o QR Code ou copie o código</p>
                    </div>
                </div>
                <button type="button" id="btnFecharModal" style="color:#9ca3af; background:none; border:none; cursor:pointer; padding:0.5rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div style="padding: 1.5rem;">
                <div class="card-base card-bordered" style="margin-bottom:1.5rem; padding: 1rem; background: linear-gradient(90deg, #f9fafb, #f3f4f6); border-radius:0.75rem;">
                    <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.875rem; color:#374151; text-transform:uppercase; font-weight:600; margin-bottom:0.5rem;">
                        <svg width="16" height="16" fill="none" stroke="#374151" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Resumo da Compra
                    </div>
                    <div class="info-list">
                        <div class="info-row"><span class="info-label">Evento</span><span class="info-value" style="font-weight:600;">{{ $event->titulo }}</span></div>
                        <div class="info-row"><span class="info-label">Quantidade</span><span class="info-value" id="modalQuantidade">1 ingresso</span></div>
                        <div class="info-row" style="border-top:1px solid #d1d5db; padding-top:0.5rem;">
                            <span class="info-label" style="font-size:1rem;">Total</span>
                            <span class="info-value" id="modalTotal" style="font-size:1.25rem; font-weight:700; color:#4f46e5;">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:1.5rem;">
                    <div class="card-base card-bordered" style="padding: 1.5rem; text-align:center;">
                        <div style="display:flex; justify-content:center; align-items:center; min-height:240px;">
                            <div id="qrcode"></div>
                        </div>
                        <p style="font-size:0.875rem; color:#6b7280; margin-top:0.75rem;">Escaneie com o app do seu banco</p>
                    </div>
                </div>

                <div style="margin-bottom:1.5rem;">
                    <label style="display:block; font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem;">Código PIX Copia e Cola:</label>
                    <div class="form-row">
                        <input type="text" id="pixCode" readonly class="input-field" style="flex:1; font-family:monospace; font-size:0.8rem;" />
                        <button type="button" id="btnCopiar" class="btn-secondary btn-inline" style="white-space:nowrap;">Copiar</button>
                    </div>
                </div>

                <div class="card-base card-bordered" style="margin-bottom:1.5rem; text-align:center; padding:1rem; background:#eff6ff; border-color:#bfdbfe;">
                    <p style="font-size:0.875rem; color:#1e40af; margin-bottom:0.25rem;">Tempo restante:</p>
                    <p id="timer" style="font-size:2rem; font-weight:700; color:#1e3a8a; margin:0;">15:00</p>
                </div>

                <form method="POST" action="{{ route('client.purchase.process', $event->id) }}" id="purchaseForm">
                    @csrf
                    <input type="hidden" name="quantidade" id="quantidadeHidden" value="1">
                    <div class="button-group">
                        <button type="button" id="btnCancelar" class="btn-secondary" style="flex:1;">Cancelar</button>
                        <button type="submit" class="btn-primary" style="flex:1;">Confirmar Pagamento</button>
                    </div>
                </form>

                <p style="font-size:0.75rem; text-align:center; color:#9ca3af; margin-top:1rem;">Pagamento simulado para demonstração</p>
            </div>
        </div>
    </div>

    <!-- QRCode.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        const valorUnitario = {{ $event->valor }};
        const maxQuantidade = {{ min(10, $event->availableTickets()) }};
        let timerInterval;

        function updateTotal() {
            const quantidade = parseInt(document.getElementById('quantidade').value);
            const total = quantidade * valorUnitario;
            const formatted = 'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('valorTotal').textContent = formatted;
        }

        function incrementQuantity() {
            const input = document.getElementById('quantidade');
            let value = parseInt(input.value);
            if (value < maxQuantidade) {
                input.value = value + 1;
                updateTotal();
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantidade');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
                updateTotal();
            }
        }

        function openModal() {
            const quantidade = parseInt(document.getElementById('quantidade').value);
            const total = quantidade * valorUnitario;
            document.getElementById('modalQuantidade').textContent = quantidade + ' ' + (quantidade === 1 ? 'ingresso' : 'ingressos');
            document.getElementById('modalTotal').textContent = 'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('quantidadeHidden').value = quantidade;
            const pixValue = total.toFixed(2).replace('.', '');
            const uuid = generateUUID();
            const pixCode = `00020126580014BR.GOV.BCB.PIX0136${uuid}520400005303986540${pixValue}5802BR5925JUNTTAE EVENTOS LTDA6009SAO PAULO62070503***6304ABCD`;
            document.getElementById('pixCode').value = pixCode;
            const qrcodeDiv = document.getElementById('qrcode');
            qrcodeDiv.innerHTML = '';
            try {
                new QRCode(qrcodeDiv, { text: pixCode, width: 200, height: 200, colorDark: '#000000', colorLight: '#ffffff', correctLevel: QRCode.CorrectLevel.H });
            } catch (error) {
                qrcodeDiv.innerHTML = '<p style="color: #ef4444;">Erro ao gerar QR Code</p>';
            }
            const modal = document.getElementById('pixModal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            startTimer();
        }

        function closeModal() {
            const modal = document.getElementById('pixModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            if (timerInterval) { clearInterval(timerInterval); }
            document.getElementById('timer').textContent = '15:00';
            document.getElementById('timer').style.color = '#1e3a8a';
        }

        function copyPixCode() {
            const pixCode = document.getElementById('pixCode');
            const copyBtn = document.getElementById('btnCopiar');
            navigator.clipboard.writeText(pixCode.value).then(() => {
                copyBtn.textContent = '✓ Copiado!';
                copyBtn.style.background = '#10b981';
                copyBtn.style.color = 'white';
                setTimeout(() => { copyBtn.textContent = 'Copiar'; copyBtn.style.background = ''; copyBtn.style.color = ''; }, 2000);
            });
        }

        function startTimer() {
            if (timerInterval) { clearInterval(timerInterval); }
            let timeLeft = 900; // 15 minutos
            timerInterval = setInterval(() => {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                const timerElement = document.getElementById('timer');
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = '00:00';
                    timerElement.style.color = '#dc2626';
                }
            }, 1000);
        }

        function generateUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) { const r = Math.random() * 16 | 0; const v = c == 'x' ? r : (r & 0x3 | 0x8); return v.toString(16); });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btnAbrir = document.getElementById('btnAbrirModal');
            if (btnAbrir) { btnAbrir.addEventListener('click', openModal); }
            const btnFechar = document.getElementById('btnFecharModal');
            if (btnFechar) { btnFechar.addEventListener('click', closeModal); }
            const btnCancelar = document.getElementById('btnCancelar');
            if (btnCancelar) { btnCancelar.addEventListener('click', closeModal); }
            const btnCopiar = document.getElementById('btnCopiar');
            if (btnCopiar) { btnCopiar.addEventListener('click', copyPixCode); }
            const modal = document.getElementById('pixModal');
            if (modal) { modal.addEventListener('click', function(e) { if (e.target.id === 'pixModal') { closeModal(); } }); }
            document.addEventListener('keydown', function(event) { if (event.key === 'Escape') { closeModal(); } });
        });
    </script>
</x-app-layout>
