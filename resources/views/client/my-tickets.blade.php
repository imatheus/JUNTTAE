<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Meus Ingressos
            </h2>
            <a href="{{ route('home') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                ← Voltar aos Eventos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            @if($purchases->isEmpty())
                <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                    <div class="mb-4">
                        <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <p class="text-lg text-gray-600 mb-6">Você ainda não possui ingressos.</p>
                    <a href="{{ route('home') }}" class="btn-primary btn-inline">
                        Ver Eventos Disponíveis
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($purchases as $purchase)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Imagem com overlay ---->
                                    <div class="md:w-1/4" style="position: relative;">
                                        @if($purchase->event->imagem)
                                            <div style="position: relative; width: 100%; height: 192px; border-radius: 0.75rem; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $purchase->event->imagem) }}" 
                                                     alt="{{ $purchase->event->titulo }}" 
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                                
                                                {{-- Overlay compacto --}}
                                                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 70%, transparent 100%); padding: 0.75rem; color: white;">
                                                    <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem;">
                                                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span style="font-weight: 600;">{{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl">
                                                <span class="text-sm text-gray-400 font-medium">Sem imagem</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Informações ---->
                                    <div class="md:w-3/4">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $purchase->event->titulo }}</h3>
                                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                    Confirmado
                                                </span>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs font-semibold text-gray-500 uppercase">Código</p>
                                                <p class="text-lg font-bold text-gray-900 font-mono">{{ $purchase->codigo_compra }}</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Data do Evento</span>
                                                <span class="block text-sm text-gray-900">{{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y \à\s H:i') }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Local</span>
                                                <span class="block text-sm text-gray-900">{{ $purchase->event->local }}</span>
                                            </div>
                                            <div>
                                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Quantidade</span>
                                                <span class="block text-sm text-gray-900">{{ $purchase->quantidade }} ingresso(s)</span>
                                            </div>
                                            <div>
                                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Valor Total</span>
                                                <span class="block text-lg font-bold text-green-600">
                                                    R$ {{ number_format($purchase->valor_total, 2, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="pt-4 border-t border-gray-200">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <a href="{{ route('client.event.show', $purchase->event->id) }}" class="btn-primary">
                                                    Ver Detalhes do Evento
                                                </a>

                                                @if($purchase->event->whatsapp_group)
                                                    <a href="{{ route('client.whatsapp.join', $purchase->event->id) }}" class="btn-success">
                                                        Grupo WhatsApp
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-4 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg">
                                            <p class="text-sm text-yellow-800">
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
