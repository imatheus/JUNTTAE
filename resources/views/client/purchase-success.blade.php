<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Compra Realizada com Sucesso!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Compra Confirmada!</h1>
                        <p class="text-gray-600">Seus ingressos foram reservados com sucesso.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-bold mb-4 text-gray-800">Detalhes da Compra</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Código da Compra:</span>
                                <span class="text-gray-900 font-mono">{{ $purchase->codigo_compra }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Evento:</span>
                                <span class="text-gray-900">{{ $purchase->event->titulo }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Data do Evento:</span>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($purchase->event->data)->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Local:</span>
                                <span class="text-gray-900">{{ $purchase->event->local }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Quantidade:</span>
                                <span class="text-gray-900">{{ $purchase->quantidade }} ingresso(s)</span>
                            </div>
                            
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-semibold text-gray-700">Valor Unitário:</span>
                                <span class="text-gray-900">R$ {{ number_format($purchase->event->valor, 2, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between pt-2">
                                <span class="font-bold text-lg text-gray-700">Valor Total:</span>
                                <span class="font-bold text-2xl text-green-600">R$ {{ number_format($purchase->valor_total, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if($purchase->event->whatsapp_group)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                            <h3 class="font-bold text-lg mb-2 text-gray-800">📱 Grupo do WhatsApp</h3>
                            <p class="text-gray-700 mb-4">
                                Este evento possui um grupo no WhatsApp! Clique no botão abaixo para entrar e ficar por dentro de todas as novidades.
                            </p>
                            <a href="{{ route('client.whatsapp.join', $purchase->event->id) }}" 
                               class="block w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded text-center">
                                Entrar no Grupo WhatsApp
                            </a>
                        </div>
                    @endif

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-800">ℹ️ Informações Importantes</h3>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Guarde o código da compra: <strong>{{ $purchase->codigo_compra }}</strong></li>
                            <li>Você pode visualizar seus ingressos a qualquer momento em "Meus Ingressos"</li>
                            <li>Apresente este código no dia do evento</li>
                            <li>Em caso de dúvidas, entre em contato com o curador do evento</li>
                        </ul>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('usuario.dashboard') }}" 
                           class="flex-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded text-center">
                            Ver Outros Eventos
                        </a>
                        <a href="{{ route('client.my-tickets') }}" 
                           class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded text-center">
                            Meus Ingressos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
