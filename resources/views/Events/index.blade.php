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
                            <div class="flex items-stretch p-4 bg-white dark:bg-gray-700 shadow-sm rounded-lg border border-gray-100 dark:border-gray-600 transition duration-150 hover:shadow-lg">
                                
                                {{-- Imagem com overlay --}}
                                <div style="position: relative; width: 200px; height: 150px; border-radius: 0.5rem; overflow: hidden; flex-shrink: 0;">
                                    <img src="{{ Storage::url($event->imagem) }}" 
                                         alt="Imagem do Evento: {{ $event->titulo }}"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                    
                                    {{-- Overlay com data --}}
                                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.5) 70%, transparent 100%); padding: 0.5rem; color: white;">
                                        <div style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem;">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span style="font-weight: 600;">{{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-grow ml-4 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $event->titulo }}</h4>
                                            @if($event->is_published)
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Publicado</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Rascunho</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
                                            <span class="font-semibold">{{ __('Local:') }}</span> {{ $event->local }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
                                            <span class="font-semibold">{{ __('Categoria:') }}</span> {{ $event->categoria }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ Str::limit($event->descricao, 80) }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col space-y-2 ml-4 justify-center">
                                    <a href="{{ route('events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium text-sm text-center px-4 py-2 border border-indigo-600 dark:border-indigo-400 rounded-md hover:bg-indigo-50 dark:hover:bg-indigo-900 transition">
                                        {{ __('Editar') }}
                                    </a>
                                    <form method="POST" action="{{ route('events.destroy', $event) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-medium text-sm px-4 py-2 border border-red-500 dark:border-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900 transition" onclick="return confirm('Tem certeza que deseja excluir este evento?');">
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
