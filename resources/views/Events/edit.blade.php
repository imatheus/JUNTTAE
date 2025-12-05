<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">Editar Evento</h2>
    </x-slot>

    <div style="max-width: 56rem; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="section-divider">
                        <strong>Informações Básicas</strong>
                    </div>

                    <div class="form-grid columns-2">
                        <div style="grid-column: 1 / -1;">
                            <x-input-label for="titulo" :value="__('Título do Evento')" />
                            <x-text-input id="titulo" class="input-field mt-1" type="text" name="titulo" :value="old('titulo', $event->titulo)" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="categoria" :value="__('Categoria')" />
                            <select id="categoria" name="categoria" class="input-field mt-1" required>
                                <option value="">Selecione uma Categoria</option>
                                <option value="Show" {{ old('categoria', $event->categoria) == 'Show' ? 'selected' : '' }}>Show</option>
                                <option value="Workshop" {{ old('categoria', $event->categoria) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Feira" {{ old('categoria', $event->categoria) == 'Feira' ? 'selected' : '' }}>Feira</option>
                            </select>
                            <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="data" :value="__('Data e Horário')" />
                            <x-text-input id="data" class="input-field mt-1" type="datetime-local" name="data" :value="old('data', \Carbon\Carbon::parse($event->data)->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('data')" class="mt-2" />
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <x-input-label for="local" :value="__('Local do Evento')" />
                            <x-text-input id="local" class="input-field mt-1" type="text" name="local" :value="old('local', $event->local)" required />
                            <x-input-error :messages="$errors->get('local')" class="mt-2" />
                        </div>
                    </div>

                    <div class="section-divider" style="margin-top: 1rem;">
                        <strong>Ingressos e Valores</strong>
                    </div>

                    <div class="form-grid columns-2">
                        <div>
                            <x-input-label for="valor" :value="__('Valor do Ingresso (R$)')" />
                            <x-text-input id="valor" class="input-field mt-1" type="number" step="0.01" name="valor" :value="old('valor', $event->valor)" required />
                            <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ingressos" :value="__('Quantidade de Ingressos')" />
                            <x-text-input id="ingressos" class="input-field mt-1" type="number" name="ingressos" :value="old('ingressos', $event->ingressos)" required />
                            <x-input-error :messages="$errors->get('ingressos')" class="mt-2" />
                        </div>
                    </div>

                    <div class="section-divider" style="margin-top: 1rem;">
                        <strong>Mídia e Descrição</strong>
                    </div>

                    <div class="form-grid columns-2">
                        <div style="grid-column: 1 / -1;">
                            <x-input-label for="imagem" :value="__('Imagem do Evento')" />
                            @if($event->imagem)
                                <div class="card-base card-bordered" style="padding: 0.75rem; margin-top: 0.5rem;">
                                    <div style="font-size:0.875rem; color:#6b7280; margin-bottom: 0.5rem;">Imagem atual:</div>
                                    <img src="{{ Storage::url($event->imagem) }}" alt="{{ $event->titulo }}" style="max-height:200px; border-radius: 0.5rem;">
                                </div>
                            @endif
                            <input id="imagem" name="imagem" type="file" class="input-field mt-1" />
                            <p class="mt-2" style="font-size: 0.875rem; color:#6b7280;">Deixe em branco para manter a imagem atual.</p>
                            <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <x-input-label for="descricao" :value="__('Descrição Completa do Evento')" />
                            <textarea id="descricao" name="descricao" rows="4" class="input-field mt-1" required>{{ old('descricao', $event->descricao) }}</textarea>
                            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                        </div>
                    </div>

                    <div class="section-divider" style="margin-top: 1rem;">
                        <strong>Configurações Adicionais</strong>
                    </div>

                    <div class="form-grid columns-2">
                        <div style="grid-column: 1 / -1;">
                            <x-input-label for="whatsapp_group" :value="__('Link do Grupo WhatsApp (Opcional)')" />
                            <x-text-input id="whatsapp_group" class="input-field mt-1" type="url" name="whatsapp_group" :value="old('whatsapp_group', $event->whatsapp_group)" placeholder="https://chat.whatsapp.com/..." />
                            <x-input-error :messages="$errors->get('whatsapp_group')" class="mt-2" />
                            <p class="mt-2" style="font-size: 0.875rem; color:#6b7280;">Cole o link de convite do grupo para liberar o acesso aos compradores.</p>
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label style="display:flex; align-items:flex-start; gap:0.5rem;">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
                                <div>
                                    <div style="font-size: 0.875rem; font-weight: 600; color:#374151;">Publicar evento (visível para clientes)</div>
                                    <div style="font-size: 0.75rem; color:#6b7280;">Se desmarcado, o evento será salvo como rascunho</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="button-group" style="margin-top: 1rem;">
                        <a href="{{ route('curador.dashboard') }}" class="btn-secondary" style="flex:1;">Cancelar</a>
                        <button type="submit" class="btn-primary" style="flex:1;">Atualizar Evento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
