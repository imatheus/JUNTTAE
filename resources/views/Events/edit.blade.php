<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card-base p-6 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
                
                <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <x-input-label for="titulo" :value="__('Título do Evento')" />
                            <x-text-input id="titulo" class="input-field block w-full mt-1" type="text" name="titulo" :value="old('titulo', $event->titulo)" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="categoria" :value="__('Categoria')" />
                            <select id="categoria" name="categoria" class="input-field block w-full mt-1" required>
                                <option value="">{{ __('Selecione uma Categoria') }}</option>
                                <option value="Show" {{ old('categoria', $event->categoria) == 'Show' ? 'selected' : '' }}>Show</option>
                                <option value="Workshop" {{ old('categoria', $event->categoria) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Feira" {{ old('categoria', $event->categoria) == 'Feira' ? 'selected' : '' }}>Feira</option>
                            </select>
                            <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="data" :value="__('Data e Horário')" />
                            <x-text-input id="data" class="input-field block w-full mt-1" type="datetime-local" name="data" :value="old('data', \Carbon\Carbon::parse($event->data)->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('data')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="local" :value="__('Local do Evento')" />
                            <x-text-input id="local" class="input-field block w-full mt-1" type="text" name="local" :value="old('local', $event->local)" required />
                            <x-input-error :messages="$errors->get('local')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="valor" :value="__('Valor do Ingresso (R$)')" />
                            <x-text-input id="valor" class="input-field block w-full mt-1" type="number" step="0.01" name="valor" :value="old('valor', $event->valor)" required />
                            <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ingressos" :value="__('Quantidade de Ingressos')" />
                            <x-text-input id="ingressos" class="input-field block w-full mt-1" type="number" name="ingressos" :value="old('ingressos', $event->ingressos)" required />
                            <x-input-error :messages="$errors->get('ingressos')" class="mt-2" />
                        </div>
                        
                        <div class="md:col-span-2">
                            <x-input-label for="imagem" :value="__('Imagem do Evento')" />
                            @if($event->imagem)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Imagem atual:</p>
                                    <img src="{{ Storage::url($event->imagem) }}" alt="{{ $event->titulo }}" class="max-h-[200px] rounded-lg shadow-sm">
                                </div>
                            @endif
                            <input id="imagem" name="imagem" type="file" class="input-field block w-full mt-1 p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Deixe em branco para manter a imagem atual.</p>
                            <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="descricao" :value="__('Descrição Completa do Evento')" />
                            <textarea id="descricao" name="descricao" rows="4" class="input-field block w-full mt-1" required>{{ old('descricao', $event->descricao) }}</textarea>
                            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="whatsapp_group" :value="__('Link do Grupo WhatsApp (Opcional)')" />
                            <x-text-input id="whatsapp_group" class="input-field block w-full mt-1" type="url" name="whatsapp_group" :value="old('whatsapp_group', $event->whatsapp_group)" placeholder="https://chat.whatsapp.com/..." />
                            <x-input-error :messages="$errors->get('whatsapp_group')" class="mt-2" />
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Cole o link de convite do grupo do WhatsApp para que os compradores possam entrar após a compra.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Publicar evento (tornar visível para clientes)') }}</span>
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Se desmarcado, o evento será salvo como rascunho e não aparecerá para os clientes.</p>
                        </div>

                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('curador.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:bg-gray-400 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button class="btn-primary py-3 px-8 text-lg">
                            {{ __('Atualizar Evento') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
