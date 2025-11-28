<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $event->titulo }}
            </h2>
            <a href="{{ route('usuario.dashboard') }}" class="text-blue-500 hover:text-blue-700">
                ← Voltar aos Eventos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
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

            @if(session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($event->imagem)
                    <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500 text-xl">Sem imagem</span>
                    </div>
                @endif

                <div class="p-8">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $event->titulo }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="space-y-3">
                            <p class="text-gray-700">
                                <span class="font-semibold">📅 Data e Hora:</span><br>
                                {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y \à\s H:i') }}
                            </p>
                            <p class="text-gray-700">
                                <span class="font-semibold">📍 Local:</span><br>
                                {{ $event->local }}
                            </p>
                            <p class="text-gray-700">
                                <span class="font-semibold">🎫 Categoria:</span><br>
                                {{ $event->categoria }}
                            </p>
                        </div>

                        <div class="space-y-3">
                            <p class="text-gray-700">
                                <span class="font-semibold">💰 Valor do Ingresso:</span><br>
                                <span class="text-2xl font-bold text-green-600">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                            </p>
                            <p class="text-gray-700">
                                <span class="font-semibold">🎟️ Ingressos Disponíveis:</span><br>
                                <span class="text-xl font-bold {{ $event->availableTickets() > 0 ? 'text-blue-600' : 'text-red-600' }}">
                                    {{ $event->availableTickets() }} de {{ $event->ingressos }}
                                </span>
                            </p>
                            <p class="text-gray-700">
                                <span class="font-semibold">👤 Curador:</span><br>
                                {{ $event->curador->name }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800">📝 Descrição</h3>
                        <p class="text-gray-700 whitespace-pre-line">{{ $event->descricao }}</p>
                    </div>

                    <div class="border-t pt-6">
                        @if($hasPurchased)
                            <div class="space-y-4">
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    <p class="font-semibold">✅ Você já possui ingressos para este evento!</p>
                                </div>

                                <div class="flex gap-4">
                                    <a href="{{ route('client.my-tickets') }}" 
                                       class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded text-center">
                                        Ver Meus Ingressos
                                    </a>

                                    @if($event->whatsapp_group)
                                        <a href="{{ route('client.whatsapp.join', $event->id) }}" 
                                           class="flex-1 bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-center">
                                            📱 Entrar no Grupo WhatsApp
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if($event->hasAvailableTickets())
                                <a href="{{ route('client.purchase.form', $event->id) }}" 
                                   class="block w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-center text-lg">
                                    🎫 Comprar Ingressos
                                </a>
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center">
                                    <p class="font-semibold">❌ Ingressos Esgotados</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
