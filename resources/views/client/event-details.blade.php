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
                @if($event->imagem)
                    <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <span class="text-lg text-gray-400 font-medium">Sem imagem</span>
                    </div>
                @endif

                <div class="p-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-8">{{ $event->titulo }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div class="space-y-4">
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Data e Hora</span>
                                <span class="block text-base text-gray-900">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y \à\s H:i') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Local</span>
                                <span class="block text-base text-gray-900">{{ $event->local }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Categoria</span>
                                <span class="block text-base text-gray-900">{{ $event->categoria }}</span>
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
                            <div>
                                <span class="block text-xs font-semibold text-gray-500 uppercase mb-1">Curador</span>
                                <span class="block text-base text-gray-900">{{ $event->curador->name }}</span>
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
