<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Dashboard do Cliente - Lista todos os eventos disponíveis
     */
    public function dashboard()
    {
        // Busca eventos futuros e publicados, ordenados por data
        $events = Event::where('data', '>=', now())
            ->where('is_published', true)
            ->orderBy('data', 'asc')
            ->get();

        // Último evento cadastrado (publicado)
        $latestEvent = Event::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('client.dashboard', compact('events', 'latestEvent'));
    }

    /**
     * Exibe detalhes de um evento específico
     */
    public function showEvent($id)
    {
        $event = Event::with('curador')->findOrFail($id);
        
        // Verifica se o usuário já comprou ingresso para este evento
        $hasPurchased = false;
        if (Auth::check()) {
            $hasPurchased = Auth::user()->hasPurchasedEvent($id);
        }

        return view('client.event-details', compact('event', 'hasPurchased'));
    }

    /**
     * Exibe o formulário de compra de ingressos
     */
    public function purchaseForm($id)
    {
        $event = Event::findOrFail($id);

        // Verifica se há ingressos disponíveis
        if (!$event->hasAvailableTickets()) {
            return redirect()->route('client.event.show', $id)
                ->with('error', 'Ingressos esgotados para este evento.');
        }

        // Verifica se o usuário já comprou ingresso
        if (Auth::user()->hasPurchasedEvent($id)) {
            return redirect()->route('client.event.show', $id)
                ->with('info', 'Você já possui ingressos para este evento.');
        }

        return view('client.purchase', compact('event'));
    }

    /**
     * Processa a compra de ingressos
     */
    public function processPurchase(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Validação
        $validated = $request->validate([
            'quantidade' => 'required|integer|min:1|max:10',
        ]);

        $quantidade = $validated['quantidade'];

        // Verifica disponibilidade
        if ($event->availableTickets() < $quantidade) {
            return redirect()->back()
                ->with('error', 'Quantidade de ingressos indisponível. Disponíveis: ' . $event->availableTickets());
        }

        // Verifica se o usuário já comprou
        if (Auth::user()->hasPurchasedEvent($id)) {
            return redirect()->route('client.event.show', $id)
                ->with('error', 'Você já possui ingressos para este evento.');
        }

        try {
            DB::beginTransaction();

            // Cria a compra
            $purchase = Purchase::create([
                'user_id' => Auth::id(),
                'event_id' => $event->id,
                'quantidade' => $quantidade,
                'valor_total' => $event->valor * $quantidade,
                'status' => 'confirmado', // Em produção, seria 'pendente' até confirmação de pagamento
                'codigo_compra' => Purchase::generateCodigoCompra(),
            ]);

            DB::commit();

            return redirect()->route('client.purchase.success', $purchase->id)
                ->with('success', 'Compra realizada com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao processar a compra. Tente novamente.');
        }
    }

    /**
     * Exibe a página de sucesso da compra
     */
    public function purchaseSuccess($purchaseId)
    {
        $purchase = Purchase::with('event')->where('user_id', Auth::id())->findOrFail($purchaseId);

        return view('client.purchase-success', compact('purchase'));
    }

    /**
     * Exibe os ingressos do usuário
     */
    public function myTickets()
    {
        $purchases = Purchase::with('event')
            ->where('user_id', Auth::id())
            ->where('status', 'confirmado')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.my-tickets', compact('purchases'));
    }

    /**
     * Redireciona para o grupo do WhatsApp do evento
     */
    public function joinWhatsAppGroup($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Verifica se o usuário comprou ingresso
        if (!Auth::user()->hasPurchasedEvent($eventId)) {
            return redirect()->route('client.event.show', $eventId)
                ->with('error', 'Você precisa comprar um ingresso para acessar o grupo.');
        }

        // Verifica se o evento tem link do grupo
        if (empty($event->whatsapp_group)) {
            return redirect()->route('client.event.show', $eventId)
                ->with('error', 'Este evento ainda não possui um grupo do WhatsApp.');
        }

        // Redireciona para o link do WhatsApp
        return redirect()->away($event->whatsapp_group);
    }
}
