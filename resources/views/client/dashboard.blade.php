<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Eventos Disponíveis') }}
            </h2>
            <a href="{{ route('client.my-tickets') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Meus Ingressos
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

            @if(session('info'))
                <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('info') }}</span>
                </div>
            @endif

            @if($events->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <p class="text-lg">Nenhum evento disponível no momento.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                            @if($event->imagem)
                                <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-500">Sem imagem</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $event->titulo }}</h3>
                                
                                <div class="mb-4 space-y-2">
                                    <p class="text-gray-600">
                                        <span class="font-semibold">📅 Data:</span> 
                                        {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-semibold">📍 Local:</span> 
                                        {{ $event->local }}
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-semibold">🎫 Categoria:</span> 
                                        {{ $event->categoria }}
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-semibold">💰 Valor:</span> 
                                        R$ {{ number_format($event->valor, 2, ',', '.') }}
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-semibold">🎟️ Disponíveis:</span> 
                                        {{ $event->availableTickets() }} de {{ $event->ingressos }}
                                    </p>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('client.event.show', $event->id) }}" 
                                       class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
