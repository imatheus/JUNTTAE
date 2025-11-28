<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'imagem', 'data', 'local', 'valor',
        'categoria', 'ingressos', 'descricao', 'user_id', 'whatsapp_group'
    ];
    
    // Relação com o Curador (usuário)
    public function curador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relação com as compras
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // Verifica se ainda há ingressos disponíveis
    public function hasAvailableTickets()
    {
        $vendidos = $this->purchases()->where('status', 'confirmado')->sum('quantidade');
        return ($this->ingressos - $vendidos) > 0;
    }

    // Retorna a quantidade de ingressos disponíveis
    public function availableTickets()
    {
        $vendidos = $this->purchases()->where('status', 'confirmado')->sum('quantidade');
        return max(0, $this->ingressos - $vendidos);
    }
}