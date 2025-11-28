<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Eventos Disponíveis</h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif

            @if($events->isEmpty())
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-lg text-gray-600">Nenhum evento disponível no momento.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($events as $event)
                        <div class="card">
                            @if($event->imagem)
                                <img src="{{ asset('storage/' . $event->imagem) }}" alt="{{ $event->titulo }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <span class="text-sm text-gray-400 font-medium">Sem imagem</span>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $event->titulo }}</h3>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex">
                                        <span class="w-20 text-xs font-semibold text-gray-500 uppercase">Data</span>
                                        <span class="flex-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-20 text-xs font-semibold text-gray-500 uppercase">Local</span>
                                        <span class="flex-1 text-sm text-gray-900">{{ $event->local }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-20 text-xs font-semibold text-gray-500 uppercase">Categoria</span>
                                        <span class="flex-1 text-sm text-gray-900">{{ $event->categoria }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-20 text-xs font-semibold text-gray-500 uppercase">Valor</span>
                                        <span class="flex-1 text-sm font-bold text-green-600">R$ {{ number_format($event->valor, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex">
                                        <span class="w-20 text-xs font-semibold text-gray-500 uppercase">Ingressos</span>
                                        <span class="flex-1 text-sm text-gray-900">{{ $event->availableTickets() }} de {{ $event->ingressos }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('client.event.show', $event->id) }}" class="btn-primary">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
