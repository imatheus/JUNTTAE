<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Meus Ingressos
            </h2>
            <a href="{{ route('usuario.dashboard') }}" class="text-blue-500 hover:text-blue-700">
                ← Voltar aos Eventos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($purchases->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <p class="text-lg mb-4">Você ainda não possui ingressos.</p>
                        <a href="{{ route('usuario.dashboard') }}" 
                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Ver Eventos Disponíveis
                        </a>
                    </div>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($purchases as $purchase)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Imagem do Evento -->
                                    <div class="md:w-1/4">
                                        @if($purchase->event->imagem)
                                            <img src="{{ asset('storage/' . $purchase->event->imagem) }}" 
                                                 alt="{{ $purchase->event->titulo }}" 
                                                 class="w-full h-48 object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center rounded-lg">
                                                <span class="text-gray-500">Sem imagem</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Informações do Ingresso -->
                                    <div class="md:w-3/4">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $purchase->event->titulo }}</h3>
                                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                                    ✓ Confirmado
                                                </span>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm text-gray-600">Código da Compra</p>
                                                <p class="font-mono font-bold text-gray-800">{{ $purchase->codigo_compra }}</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">📅 Data do Evento:</span><br>
                                                    {{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y \à\s H:i') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">📍 Local:</span><br>
                                                    {{ $purchase->event->local }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">🎫 Quantidade:</span><br>
                                                    {{ $purchase->quantidade }} ingresso(s)
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">💰 Valor Total:</span><br>
                                                    <span class="text-lg font-bold text-green-600">
                                                        R$ {{ number_format($purchase->valor_total, 2, ',', '.') }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="border-t pt-4">
                                            <div class="flex gap-3">
                                                <a href="{{ route('client.event.show', $purchase->event->id) }}" 
                                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Ver Detalhes do Evento
                                                </a>

                                                @if($purchase->event->whatsapp_group)
                                                    <a href="{{ route('client.whatsapp.join', $purchase->event->id) }}" 
                                                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                        📱 Grupo WhatsApp
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-3">
                                            <p class="text-sm text-yellow-700">
                                                <strong>Lembre-se:</strong> Apresente o código <strong>{{ $purchase->codigo_compra }}</strong> no dia do evento.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
