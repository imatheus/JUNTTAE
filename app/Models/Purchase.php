<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'quantidade',
        'valor_total',
        'status',
        'codigo_compra',
    ];

    /**
     * Relação com o usuário (cliente)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relação com o evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Gera um código único para a compra
     */
    public static function generateCodigoCompra()
    {
        do {
            $codigo = 'COMP-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while (self::where('codigo_compra', $codigo)->exists());

        return $codigo;
    }
}
