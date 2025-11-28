<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title">{{ __('Eventos (Junttaê)') }}</h2>
    </x-slot>

    <div>
        <div class="card">
            <div class="card-body">
                {{-- 1. EVENTO EM DESTAQUE (Dinamizado) --}}
                @isset($eventoDestaque)
                    <div class="mb-6">
                        <div class="hero-card">
                            {{-- Imagem Dinâmica --}}
                            <img src="{{ Storage::url($eventoDestaque->imagem) }}" alt="{{ $eventoDestaque->nome }}" class="hero-img" />
                            <div class="hero-overlay">
                                <h3 class="hero-title">{{ $eventoDestaque->titulo }}</h3>
                                <p class="hero-subtitle">{{ $eventoDestaque->local }}</p>
                                <div class="hero-meta">
                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    <span>{{ \Carbon\Carbon::parse($eventoDestaque->data)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

                {{-- 2. LISTA DE PRÓXIMOS EVENTOS (Dinamizado) --}}
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 1rem;">
                    <h4 style="font-size: 1.5rem; font-weight: 700; padding-bottom: 0.5rem; border-bottom: 1px solid var(--color-gray-200);">Eventos Cadastrados</h4>
                    <a href="{{ route('events.create') }}" class="btn-primary btn-inline">+ Novo Evento</a>
                </div>

                <div class="event-list">
                    @forelse ($proximosEventos as $event)
                        <div class="event-item">
                            {{-- Miniatura Dinâmica --}}
                            <img src="{{ Storage::url($event->imagem) }}" alt="{{ $event->titulo }}" class="event-thumb">
                            
                            <div class="event-info">
                                <div class="event-title-row">
                                    <h5 class="event-title">{{ $event->titulo }}</h5>
                                    @if($event->is_published)
                                        <span class="badge badge-success">Publicado</span>
                                    @else
                                        <span class="badge badge-warning">Rascunho</span>
                                    @endif
                                </div>
                                <p class="event-meta">{{ $event->categoria ?? 'Sem Categoria' }} • {{ \Carbon\Carbon::parse($event->data)->format('d/m/Y H:i') }}</p>
                                <p class="event-location">{{ $event->local }}</p>
                            </div>

                            <div class="event-actions">
                                {{-- Botão Editar --}}
                                <a href="{{ route('events.edit', $event) }}" class="btn-primary btn-inline" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">Editar</a>
                                
                                {{-- Botão Excluir --}}
                                <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.')" class="btn-danger btn-inline" style="padding: 0.5rem 0.75rem; font-size: 0.75rem;">Excluir</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <p style="font-size: 1.25rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">
                                {{ __('Você ainda não possui eventos cadastrados.') }}
                            </p>
                            <p style="color: #6b7280; margin-bottom: 1rem;">
                                {{ __('Use o botão "Novo Evento" para começar a gerenciar e publicar seus eventos.') }}
                            </p>
                            <a href="{{ route('events.create') }}" class="btn-primary btn-inline">+ Cadastrar Evento</a>
                        </div>
                    @endforelse
                </div>

                {{-- Removi o botão "Ver mais" se a lista for completa --}}
                {{-- Adicione paginação se necessário: {{ $proximosEventos->links() }} --}}

            </div>
        </div>
    </div>

    {{-- Botão Flutuante para Adicionar Evento --}}
    <a href="{{ route('events.create') }}" class="fab" aria-label="Adicionar Evento">
        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </a>
</x-app-layout>