<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Comprar Ingressos
            </h2>
            <a href="{{ route('client.event.show', $event->id) }}" class="text-blue-500 hover:text-blue-700">
                ← Voltar ao Evento
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $event->titulo }}</h1>

                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-700">
                                    <span class="font-semibold">📅 Data:</span><br>
                                    {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-700">
                                    <span class="font-semibold">📍 Local:</span><br>
                                    {{ $event->local }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-700">
                                    <span class="font-semibold">💰 Valor Unitário:</span><br>
                                    <span class="text-xl font-bold text-green-600">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-700">
                                    <span class="font-semibold">🎟️ Disponíveis:</span><br>
                                    <span class="text-xl font-bold text-blue-600">{{ $event->availableTickets() }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('client.purchase.process', $event->id) }}" id="purchaseForm">
                        @csrf

                        <div class="mb-6">
                            <label for="quantidade" class="block text-gray-700 text-sm font-bold mb-2">
                                Quantidade de Ingressos *
                            </label>
                            <input type="number" 
                                   name="quantidade" 
                                   id="quantidade" 
                                   min="1" 
                                   max="{{ min(10, $event->availableTickets()) }}" 
                                   value="1"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quantidade') border-red-500 @enderror"
                                   required
                                   onchange="updateTotal()">
                            @error('quantidade')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-600 text-xs mt-1">Máximo: {{ min(10, $event->availableTickets()) }} ingressos</p>
                        </div>

                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-700">Valor Total:</span>
                                <span class="text-2xl font-bold text-green-600" id="valorTotal">
                                    R$ {{ number_format($event->valor, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            <strong>Importante:</strong> Ao confirmar a compra, você receberá um código de confirmação e poderá acessar o grupo do WhatsApp do evento (se disponível).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="{{ route('client.event.show', $event->id) }}" 
                               class="flex-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded text-center">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="flex-1 bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                                Confirmar Compra
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTotal() {
            const quantidade = document.getElementById('quantidade').value;
            const valorUnitario = {{ $event->valor }};
            const total = quantidade * valorUnitario;
            
            document.getElementById('valorTotal').textContent = 
                'R$ ' + total.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>
</x-app-layout>
