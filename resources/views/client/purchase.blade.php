<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Comprar Ingressos
            </h2>
            <a href="{{ route('client.event.show', $event->id) }}" class="text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors">
                ← Voltar ao Evento
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Etapa 1: Seleção de Quantidade -->
            <div id="step1" class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-8">
                    <!-- Informações do Evento -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $event->titulo }}</h1>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-gray-50 rounded-lg">
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Data e Hora</span>
                                <span class="block text-base text-gray-900">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Local</span>
                                <span class="block text-base text-gray-900">{{ $event->local }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Valor Unitário</span>
                                <span class="block text-2xl font-bold text-green-600">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Ingressos Disponíveis</span>
                                <span class="block text-xl font-bold text-blue-600">{{ $event->availableTickets() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Formulário de Quantidade -->
                    <div class="mb-8">
                        <label for="quantidade" class="block text-sm font-semibold text-gray-700 mb-2">
                            Quantidade de Ingressos
                        </label>
                        <input type="number" 
                               name="quantidade" 
                               id="quantidade" 
                               min="1" 
                               max="{{ min(10, $event->availableTickets()) }}" 
                               value="1"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg"
                               onchange="updateTotal()">
                        <p class="text-sm text-gray-500 mt-2">Máximo: {{ min(10, $event->availableTickets()) }} ingressos por compra</p>
                    </div>

                    <!-- Resumo do Valor -->
                    <div class="mb-8 p-6 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg border border-indigo-100">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Valor Total:</span>
                            <span class="text-3xl font-bold text-indigo-600" id="valorTotal">
                                R$ {{ number_format($event->valor, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="flex gap-4">
                        <a href="{{ route('client.event.show', $event->id) }}" 
                           class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg text-center transition-colors">
                            Cancelar
                        </a>
                        <button type="button" 
                                onclick="showPixPayment()"
                                class="flex-1 btn-primary">
                            Continuar para Pagamento
                        </button>
                    </div>
                </div>
            </div>

            <!-- Etapa 2: Pagamento PIX (Oculto inicialmente) -->
            <div id="step2" class="bg-white rounded-xl shadow-md overflow-hidden hidden">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Pagamento via PIX</h2>
                        <p class="text-gray-600">Escaneie o QR Code ou copie o código PIX</p>
                    </div>

                    <!-- Resumo da Compra -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-semibold text-gray-700 uppercase mb-4">Resumo da Compra</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Evento:</span>
                                <span class="font-semibold text-gray-900">{{ $event->titulo }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Quantidade:</span>
                                <span class="font-semibold text-gray-900" id="resumoQuantidade">1 ingresso(s)</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-200">
                                <span class="text-lg font-semibold text-gray-700">Total:</span>
                                <span class="text-2xl font-bold text-indigo-600" id="resumoTotal">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code PIX -->
                    <div class="mb-8">
                        <div class="bg-white border-2 border-gray-200 rounded-lg p-8 text-center">
                            <div class="inline-block p-4 bg-white">
                                <!-- QR Code gerado dinamicamente -->
                                <div id="qrcode" class="mx-auto"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-4">Escaneie este QR Code com o app do seu banco</p>
                        </div>
                    </div>

                    <!-- Código PIX Copia e Cola -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Ou copie o código PIX:
                        </label>
                        <div class="flex gap-2">
                            <input type="text" 
                                   id="pixCode" 
                                   value="00020126580014BR.GOV.BCB.PIX0136{{ Str::uuid() }}520400005303986540{{ number_format($event->valor, 2, '', '') }}5802BR5925JUNTTAE EVENTOS LTDA6009SAO PAULO62070503***6304ABCD"
                                   readonly
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-sm font-mono">
                            <button type="button" 
                                    onclick="copyPixCode()"
                                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                                Copiar
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Cole este código no app do seu banco na opção PIX Copia e Cola</p>
                    </div>

                    <!-- Instruções -->
                    <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                        <h4 class="text-sm font-semibold text-blue-900 mb-2">Instruções:</h4>
                        <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                            <li>Abra o app do seu banco</li>
                            <li>Escolha a opção PIX</li>
                            <li>Escaneie o QR Code ou cole o código PIX</li>
                            <li>Confirme o pagamento</li>
                            <li>Após o pagamento, clique em "Confirmar Pagamento" abaixo</li>
                        </ol>
                    </div>

                    <!-- Timer Fake -->
                    <div class="mb-8 text-center">
                        <p class="text-sm text-gray-600 mb-2">Tempo restante para pagamento:</p>
                        <p class="text-2xl font-bold text-gray-900" id="timer">15:00</p>
                    </div>

                    <!-- Formulário de Confirmação -->
                    <form method="POST" action="{{ route('client.purchase.process', $event->id) }}" id="purchaseForm">
                        @csrf
                        <input type="hidden" name="quantidade" id="quantidadeHidden" value="1">
                        
                        <div class="flex gap-4">
                            <button type="button" 
                                    onclick="backToStep1()"
                                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-colors">
                                Voltar
                            </button>
                            <button type="submit" 
                                    class="flex-1 btn-primary">
                                Confirmar Pagamento
                            </button>
                        </div>
                    </form>

                    <p class="text-xs text-center text-gray-500 mt-4">
                        Este é um processo de pagamento simulado para fins de demonstração
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- QRCode.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        const valorUnitario = {{ $event->valor }};
        let timerInterval;

        function updateTotal() {
            const quantidade = parseInt(document.getElementById('quantidade').value);
            const total = quantidade * valorUnitario;
            
            const formatted = 'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('valorTotal').textContent = formatted;
        }

        function showPixPayment() {
            const quantidade = parseInt(document.getElementById('quantidade').value);
            const total = quantidade * valorUnitario;
            
            // Atualiza resumo
            document.getElementById('resumoQuantidade').textContent = quantidade + ' ingresso(s)';
            document.getElementById('resumoTotal').textContent = 'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            document.getElementById('quantidadeHidden').value = quantidade;
            
            // Atualiza código PIX com valor correto
            const pixValue = total.toFixed(2).replace('.', '');
            const pixCode = `00020126580014BR.GOV.BCB.PIX0136{{ Str::uuid() }}520400005303986540${pixValue}5802BR5925JUNTTAE EVENTOS LTDA6009SAO PAULO62070503***6304ABCD`;
            document.getElementById('pixCode').value = pixCode;
            
            // Gera QR Code
            document.getElementById('qrcode').innerHTML = '';
            new QRCode(document.getElementById('qrcode'), {
                text: pixCode,
                width: 256,
                height: 256,
                colorDark: '#000000',
                colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.H
            });
            
            // Mostra step 2 e esconde step 1
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            
            // Inicia timer
            startTimer();
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function backToStep1() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            
            // Para o timer
            if (timerInterval) {
                clearInterval(timerInterval);
            }
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function copyPixCode() {
            const pixCode = document.getElementById('pixCode');
            pixCode.select();
            pixCode.setSelectionRange(0, 99999); // Para mobile
            
            navigator.clipboard.writeText(pixCode.value).then(() => {
                // Feedback visual
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copiado!';
                button.classList.add('bg-green-500', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-800');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-500', 'text-white');
                    button.classList.add('bg-gray-200', 'text-gray-800');
                }, 2000);
            });
        }

        function startTimer() {
            let timeLeft = 900; // 15 minutos em segundos
            
            timerInterval = setInterval(() => {
                timeLeft--;
                
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                document.getElementById('timer').textContent = 
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('timer').textContent = '00:00';
                    document.getElementById('timer').classList.add('text-red-600');
                }
            }, 1000);
        }
    </script>
</x-app-layout>
