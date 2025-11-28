<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Novo Evento') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                
                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    
                    <!-- Informações Básicas -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                            📋 Informações Básicas
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="titulo" :value="__('Título do Evento')" class="text-xs font-medium" />
                                <x-text-input id="titulo" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="text" name="titulo" :value="old('titulo')" required autofocus placeholder="Ex: Festival de Música 2024" />
                                <x-input-error :messages="$errors->get('titulo')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="categoria" :value="__('Categoria')" class="text-xs font-medium" />
                                <select id="categoria" name="categoria" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" required>
                                    <option value="">{{ __('Selecione') }}</option>
                                    <option value="Show" {{ old('categoria') == 'Show' ? 'selected' : '' }}>🎵 Show</option>
                                    <option value="Workshop" {{ old('categoria') == 'Workshop' ? 'selected' : '' }}>🎓 Workshop</option>
                                    <option value="Feira" {{ old('categoria') == 'Feira' ? 'selected' : '' }}>🎪 Feira</option>
                                </select>
                                <x-input-error :messages="$errors->get('categoria')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="data" :value="__('Data e Horário')" class="text-xs font-medium" />
                                <x-text-input id="data" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="datetime-local" name="data" :value="old('data')" required />
                                <x-input-error :messages="$errors->get('data')" class="mt-1" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="local" :value="__('Local do Evento')" class="text-xs font-medium" />
                                <x-text-input id="local" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="text" name="local" :value="old('local')" required placeholder="Ex: Centro de Convenções - Av. Principal, 123" />
                                <x-input-error :messages="$errors->get('local')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Ingressos e Valores -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                            🎫 Ingressos e Valores
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="valor" :value="__('Valor do Ingresso (R$)')" class="text-xs font-medium" />
                                <x-text-input id="valor" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="number" step="0.01" name="valor" :value="old('valor')" required placeholder="0.00" />
                                <x-input-error :messages="$errors->get('valor')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="ingressos" :value="__('Quantidade de Ingressos')" class="text-xs font-medium" />
                                <x-text-input id="ingressos" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="number" name="ingressos" :value="old('ingressos')" required placeholder="100" />
                                <x-input-error :messages="$errors->get('ingressos')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Mídia e Descrição -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                            🖼️ Mídia e Descrição
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="imagem" :value="__('Imagem do Evento')" class="text-xs font-medium" />
                                <input id="imagem" name="imagem" type="file" accept="image/*" class="block w-full mt-1 text-sm text-gray-600 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300 cursor-pointer" required />
                                <p class="mt-1 text-xs text-gray-500">Formatos aceitos: JPG, PNG, GIF (máx. 2MB)</p>
                                <x-input-error :messages="$errors->get('imagem')" class="mt-1" />
                            </div>

                            <div>
                                <x-input-label for="descricao" :value="__('Descrição Completa do Evento')" class="text-xs font-medium" />
                                <textarea id="descricao" name="descricao" rows="4" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400 resize-none" required placeholder="Descreva os detalhes do evento, atrações, programação...">{{ old('descricao') }}</textarea>
                                <x-input-error :messages="$errors->get('descricao')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Configurações Adicionais -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide border-b border-gray-200 dark:border-gray-700 pb-2">
                            ⚙️ Configurações Adicionais
                        </h3>
                        
                        <div class="space-y-3">
                            <div>
                                <x-input-label for="whatsapp_group" :value="__('Link do Grupo WhatsApp (Opcional)')" class="text-xs font-medium" />
                                <x-text-input id="whatsapp_group" class="block w-full mt-1 text-sm py-2 px-3 rounded-md border-gray-300 dark:border-gray-600 focus:border-indigo-400 focus:ring-1 focus:ring-indigo-400" type="url" name="whatsapp_group" :value="old('whatsapp_group')" placeholder="https://chat.whatsapp.com/..." />
                                <p class="text-xs text-gray-500 mt-1">💬 Compradores poderão entrar no grupo após a compra</p>
                                <x-input-error :messages="$errors->get('whatsapp_group')" class="mt-1" />
                            </div>

                            <div class="bg-gray-50 dark:bg-gray-900 rounded-md p-3">
                                <label class="flex items-start cursor-pointer">
                                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="mt-0.5 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Publicar evento imediatamente') }}</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Se desmarcado, o evento será salvo como rascunho</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('curador.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                            ← {{ __('Voltar') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                            ✓ {{ __('Salvar Evento') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
