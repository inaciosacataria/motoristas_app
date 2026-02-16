<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Relacionamento polimórfico
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * Marca notificação como lida
     */
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    /**
     * Verifica se a notificação foi lida
     */
    public function isRead()
    {
        return $this->read_at !== null;
    }

    /**
     * Scope para notificações não lidas
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope para notificações lidas
     */
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }
}
