<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Tela: Meus Eventos (Dashboard do Curador)
     */
    public function index()
    {
        // Garante que apenas os eventos do curador logado sejam listados
        $proximosEventos = Event::where('user_id', Auth::id())->orderBy('data', 'asc')->get();
        
        // Pega o primeiro evento como destaque (ou o mais próximo)
        $eventoDestaque = $proximosEventos->first();

        return view('curadorDashboard', [
            'proximosEventos' => $proximosEventos,
            'eventoDestaque' => $eventoDestaque,
        ]);
    }

    /**
     * Tela: Cadastrar Evento
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Lógica: Salvar Evento
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:50',
            'ingressos' => 'required|integer|min:1',
            'descricao' => 'required|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'whatsapp_group' => 'nullable|url', // Link do grupo WhatsApp (opcional)
            'is_published' => 'nullable|boolean',
        ]);

        // 2. Upload da Imagem
        if ($request->hasFile('imagem')) {
            // Salva no disco 'public', na pasta 'events'.
            // Retorna um caminho limpo, por exemplo: 'events/nome-unico-do-arquivo.jpg'.
            $imagePath = $request->file('imagem')->store('events', 'public');
            
            // Atribui o caminho limpo ao array validado, que será salvo no banco de dados.
            $validated['imagem'] = $imagePath;
        }

        // 3. Criação do Evento
        $event = Event::create([
            ...$validated,
            'user_id' => Auth::id(), // Atribui o ID do curador logado
        ]);

        // 4. Redirecionamento
        return redirect()->route('curador.dashboard')
                         ->with('status', 'Evento "' . $event->titulo . '" cadastrado com sucesso!');
    }

    /**
     * Tela: Editar Evento
     */
    public function edit(Event $event)
    {
        // Verifica se o evento pertence ao curador logado
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para editar este evento.');
        }

        return view('events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Lógica: Atualizar Evento
     */
    public function update(Request $request, Event $event)
    {
        // Verifica se o evento pertence ao curador logado
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para atualizar este evento.');
        }

        // 1. Validação dos dados
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:50',
            'ingressos' => 'required|integer|min:1',
            'descricao' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Imagem é opcional na edição
            'whatsapp_group' => 'nullable|url',
            'is_published' => 'nullable|boolean',
        ]);

        // 2. Upload da Imagem (se fornecida)
        if ($request->hasFile('imagem')) {
            // Deleta a imagem antiga se existir
            if ($event->imagem && Storage::disk('public')->exists($event->imagem)) {
                Storage::disk('public')->delete($event->imagem);
            }

            // Salva a nova imagem
            $imagePath = $request->file('imagem')->store('events', 'public');
            $validated['imagem'] = $imagePath;
        }

        // 3. Atualização do Evento
        $event->update($validated);

        // 4. Redirecionamento
        return redirect()->route('curador.dashboard')
                         ->with('status', 'Evento "' . $event->titulo . '" atualizado com sucesso!');
    }

    /**
     * Lógica: Excluir Evento
     */
    public function destroy(Event $event)
    {
        // Verifica se o evento pertence ao curador logado
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para excluir este evento.');
        }

        // Deleta a imagem do evento
        if ($event->imagem && Storage::disk('public')->exists($event->imagem)) {
            Storage::disk('public')->delete($event->imagem);
        }

        // Armazena o título antes de deletar
        $titulo = $event->titulo;

        // Deleta o evento
        $event->delete();

        // Redirecionamento
        return redirect()->route('curador.dashboard')
                         ->with('status', 'Evento "' . $titulo . '" excluído com sucesso!');
    }
}