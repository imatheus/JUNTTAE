 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos (Junttaê)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- 1. EVENTO EM DESTAQUE (Dinamizado) --}}
                    @isset($eventoDestaque)
                    <div class="mb-8">
                        <div class=" bg-gray-300 rounded-lg relative overflow-hidden shadow-lg">
                            {{-- Imagem Dinâmica --}}
                            <img src="{{ Storage::url($eventoDestaque->imagem) }}" 
                                alt="{{ $eventoDestaque->nome }}" 
                                class="w-full h-full object-cover"/>
                            
                            <div class="absolute inset-0 bg-black bg-opacity-40 p-4 flex flex-col justify-end">
                                <h3 class="text-4xl font-extrabold text-white">{{ $eventoDestaque->titulo }}</h3>
                                <p class="text-xl text-white">{{ $eventoDestaque->local }}</p> 
                                <div class="flex items-center text-white mt-2">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    {{-- Data Dinâmica --}}
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($eventoDestaque->data)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset

                    {{-- 2. LISTA DE PRÓXIMOS EVENTOS (Dinamizado) --}}
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-2xl font-bold border-b pb-2">Eventos Cadastrados</h4>
                        <a href="{{ route('events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Novo Evento
                        </a>
                    </div>

                    @forelse ($proximosEventos as $event)
                    <div class="flex items-center mb-4 p-4 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition duration-150 ease-in-out">
                        {{-- Miniatura Dinâmica --}}
                        <img src="{{ Storage::url($event->imagem) }}" alt="{{ $event->titulo }}" class="max-h-[64px] max-w-[64px] shrink-0 rounded-lg object-cover mr-4 shadow-sm">
                        
                        <div class="flex-grow">
                            <div class="flex items-center gap-2">
                                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $event->titulo }}</h5>
                                @if($event->is_published)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Rascunho
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->categoria ?? 'Sem Categoria' }} • {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 truncate">{{ $event->local }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            {{-- Botão Editar --}}
                            <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Editar
                            </a>
                            
                            {{-- Botão Excluir --}}
                            <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.')" class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center p-10 bg-gray-50 dark:bg-gray-700 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg">
                        <p class="text-xl font-medium text-gray-600 dark:text-gray-300 mb-4">
                            {{ __('Você ainda não possui eventos cadastrados.') }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">
                            {{ __('Use o botão "Novo Evento" para começar a gerenciar e publicar seus eventos.') }}
                        </p>
                        <a href="{{ route('events.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Cadastrar Evento
                        </a>
                    </div>
                    @endforelse

                    {{-- Removi o botão "Ver mais" se a lista for completa --}}
                    {{-- Adicione paginação se necessário: {{ $proximosEventos->links() }} --}}

                </div>
            </div>
        </div>
    </div>

    {{-- Botão Flutuante para Adicionar Evento --}}
    <a href="{{ route('events.create') }}" class="fixed bottom-8 right-8 inline-flex items-center justify-center w-16 h-16 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150 hover:shadow-xl">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </a>
</x-app-layout>