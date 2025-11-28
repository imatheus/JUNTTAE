<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ $event->titulo }}
            </h2>
            <a href="{{ route('home') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                ← Voltar aos Eventos
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
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

            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                    <p class="text-sm text-blue-700">{{ session('info') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                {{-- Banner com overlay de título --}}
                <div style="position: relative; width: 100%; height: 400px; overflow: hidden;">
                    @if($event->imagem)
                        <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-lg text-gray-400 font-medium">Sem imagem</span>
                        </div>
                    @endif
                    
                    {{-- Overlay com título e data --}}
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.7) 60%, transparent 100%); padding: 2.5rem 2rem 2rem; color: white;">
                        <h1 style="font-size: 2.5rem; font-weight: 800; margin: 0 0 1rem 0; line-height: 1.2; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                            {{ $event->titulo }}
                        </h1>
                        <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 1.125rem; opacity: 0.95;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span style="font-weight: 600; text-shadow: 0 1px 3px rgba(0,0,0,0.3);">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y \à\s H:i') }}</span>
                        </div>
                        <p style="margin: 0.75rem 0 0 0; font-size: 1rem; opacity: 0.9; display: flex; align-items: center; gap: 0.5rem;">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $event->local }}
                        </p>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-4">
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Categoria</span>
                                <span class="block text-base text-gray-900">{{ $event->categoria }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Curador</span>
                                <span class="block text-base text-gray-900">{{ $event->curador->name }}</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Valor do Ingresso</span>
                                <span class="block text-2xl font-bold text-green-600">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Ingressos Disponíveis</span>
                                <span class="block text-xl font-bold {{ $event->availableTickets() > 0 ? 'text-blue-600' : 'text-red-600' }}">
                                    {{ $event->availableTickets() }} de {{ $event->ingressos }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase mb-2">Descrição</h3>
                        <p class="text-base text-gray-700 leading-relaxed whitespace-pre-line">{{ $event->descricao }}</p>
                    </div>

                    <div class="pt-6 border-t border-gray-200">
                        @auth
                            @if($hasPurchased)
                                <div class="space-y-4">
                                    <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                                        <p class="text-sm font-semibold text-green-700">Você já possui ingressos para este evento!</p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <a href="{{ route('client.my-tickets') }}" class="btn-primary">
                                            Ver Meus Ingressos
                                        </a>

                                        @if($event->whatsapp_group)
                                            <a href="{{ route('client.whatsapp.join', $event->id) }}" class="btn-success">
                                                Grupo WhatsApp
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @else
                                @if($event->hasAvailableTickets())
                                    <a href="{{ route('client.purchase.form', $event->id) }}" class="btn-primary">
                                        Comprar Ingressos
                                    </a>
                                @else
                                    <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-center">
                                        <p class="text-sm font-semibold text-red-700">Ingressos Esgotados</p>
                                    </div>
                                @endif
                            @endif
                        @else
                            @if($event->hasAvailableTickets())
                                <div class="p-6 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                                    <p class="text-sm font-medium text-gray-700 text-center mb-4">
                                        Para comprar ingressos, você precisa estar logado.
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <a href="{{ route('login') }}" class="btn-secondary">
                                            Entrar
                                        </a>
                                        <a href="{{ route('register') }}" class="btn-primary">
                                            Cadastrar
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-center">
                                    <p class="text-sm font-semibold text-red-700">Ingressos Esgotados</p>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
