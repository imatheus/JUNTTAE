<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Event; // Importado para uso na relação events()

class User extends Authenticatable
{
    // Apenas as traits padrão são usadas: HasFactory e Notifiable
    use HasFactory, Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf_cnpj',    
        'tipo_usuario', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    

    // RELACIONAMENTOS


    /**
     * Define a relação: Um Curador (User) pode ter muitos Eventos.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Define a relação: Um Usuário pode ter muitas Compras.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Verifica se o usuário é um curador
     */
    public function isCurador(): bool
    {
        return $this->tipo_usuario === 'curador';
    }

    /**
     * Verifica se o usuário comprou ingresso para um evento específico
     */
    public function hasPurchasedEvent($eventId): bool
    {
        return $this->purchases()
            ->where('event_id', $eventId)
            ->where('status', 'confirmado')
            ->exists();
    }
}