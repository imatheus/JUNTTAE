<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meus Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex justify-end">
                <a href="{{ route('events.create') }}" class="btn-primary py-3 px-6 text-center text-lg inline-block transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
                    + {{ __('Cadastrar Novo Evento') }}
                </a>
            </div>

            <div class="card-base p-6 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200 border-b pb-2">
                    {{ __('Eventos Cadastrados') }}
                </h3>
                
                @if ($events->isEmpty())
                    <div class="card-alert text-center p-10 bg-gray-50 border-2 p-4 border-dashed border-gray-300 rounded-lg">
                        <p class="text-xl font-medium text-gray-600 mb-4">
                            {{ __('Você ainda não possui eventos cadastrados.') }}
                        </p>
                        <p class="text-gray-500 mb-6">
                            {{ __('Use o botão "Cadastrar Novo Evento" para começar a gerenciar e publicar seus eventos.') }}
                        </p>
                        <a href="{{ route('events.create') }}" class="btn-primary py-2 px-6 text-base inline-block">
                             {{ __('Cadastrar Evento') }}
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($events as $event)
                            <div class="event-item flex items-center p-4 bg-white shadow-sm rounded-lg border border-gray-100 transition duration-150 hover:shadow-lg">
                                
                                <img src="{{ Storage::url($event->imagem) }}" alt="Imagem do Evento: {{ $event->nome }}">

                                <div class="flex-grow">
                                    <h4 class="text-xl font-bold text-gray-800">{{ $event->titulo }}</h4>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">{{ __('Data:') }}</span> {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">{{ __('Local:') }}</span> {{ $event->local }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">{{ Str::limit($event->descricao, 50) }}</p>
                                </div>

                                <div class="flex flex-col space-y-2 ml-4">
                                    <a href="{{ route('events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                        {{ __('Editar') }}
                                    </a>
                                    <form method="POST" action="{{ route('events.destroy', $event) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm" onclick="return confirm('Tem certeza que deseja excluir este evento?');">
                                            {{ __('Excluir') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>