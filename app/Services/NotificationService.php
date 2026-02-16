<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Criar notificação para um usuário
     */
    public function create($userId, $type, $data)
    {
        return Notification::create([
            'notifiable_id' => $userId,
            'notifiable_type' => User::class,
            'type' => $type,
            'data' => json_encode($data),
        ]);
    }

    /**
     * Notificar nova candidatura para empregador
     */
    public function notifyNewCandidatura($empregadorId, $anuncioId, $candidatoNome)
    {
        return $this->create($empregadorId, 'nova_candidatura', [
            'title' => 'Nova Candidatura',
            'message' => "$candidatoNome candidatou-se a uma de suas vagas.",
            'anuncio_id' => $anuncioId,
            'icon' => 'fa-user-plus',
            'url' => "/candidatos-anuncio/$anuncioId",
        ]);
    }

    /**
     * Notificar resposta de candidatura para candidato
     */
    public function notifyCandidaturaAprovada($candidatoId, $anuncioTitulo, $empresaNome)
    {
        return $this->create($candidatoId, 'candidatura_aprovada', [
            'title' => 'Candidatura Aprovada!',
            'message' => "Sua candidatura para $anuncioTitulo na empresa $empresaNome foi aprovada!",
            'icon' => 'fa-check-circle',
            'url' => "/candidato",
        ]);
    }

    /**
     * Notificar novo anúncio para candidatos
     */
    public function notifyNovoAnuncio($anuncioId, $anuncioTitulo, $categoriaId = null)
    {
        // Buscar candidatos da mesma categoria
        $query = User::where('privilegio', 'candidato');
        
        if ($categoriaId) {
            $query->whereHas('candidato', function($q) use ($categoriaId) {
                $q->where('categoria_id', $categoriaId);
            });
        }
        
        $candidatos = $query->get();
        
        foreach ($candidatos as $candidato) {
            $this->create($candidato->id, 'novo_anuncio', [
                'title' => 'Nova Vaga Disponível',
                'message' => "Nova vaga disponível: $anuncioTitulo",
                'anuncio_id' => $anuncioId,
                'icon' => 'fa-briefcase',
                'url' => "/anuncio/$anuncioId",
            ]);
        }
    }

    /**
     * Notificar conta ativada
     */
    public function notifyContaAtivada($userId)
    {
        return $this->create($userId, 'conta_ativada', [
            'title' => 'Conta Ativada!',
            'message' => 'Sua conta foi ativada com sucesso. Você já pode publicar anúncios.',
            'icon' => 'fa-check-circle',
            'url' => "/empregador",
        ]);
    }

    /**
     * Buscar notificações não lidas
     */
    public function getUnread($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($notification) {
                $notification->data = json_decode($notification->data, true);
                return $notification;
            });
    }

    /**
     * Marcar notificação como lida
     */
    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        return $notification;
    }

    /**
     * Marcar todas como lidas
     */
    public function markAllAsRead($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Contar notificações não lidas
     */
    public function countUnread($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', User::class)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Deletar notificações antigas (mais de 30 dias)
     */
    public function deleteOld()
    {
        return Notification::where('created_at', '<', now()->subDays(30))
            ->delete();
    }
}

