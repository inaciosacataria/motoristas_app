<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth');
        $this->notificationService = $notificationService;
    }

    /**
     * Listar todas as notificações
     */
    public function index()
    {
        $notifications = $this->notificationService->getUnread(Auth::id());
        $count = $this->notificationService->countUnread(Auth::id());
        
        return view('notifications.index', compact('notifications', 'count'));
    }

    /**
     * Buscar notificações não lidas (API para AJAX)
     */
    public function getUnread()
    {
        $notifications = $this->notificationService->getUnread(Auth::id());
        $count = $this->notificationService->countUnread(Auth::id());
        $list = $notifications->map(function ($n) {
            return [
                'id' => $n->id,
                'type' => $n->type,
                'data' => $n->data,
                'created_at' => $n->created_at?->toIso8601String(),
                'created_at_human' => $n->created_at?->diffForHumans(),
            ];
        });
        
        return response()->json([
            'success' => true,
            'notifications' => $list,
            'count' => $count,
        ]);
    }

    /**
     * Marcar como lida
     */
    public function markAsRead($id)
    {
        $notification = \App\Models\Notification::where('id', $id)
            ->where('notifiable_id', Auth::id())
            ->first();
        
        if (!$notification) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Notificação não encontrada'], 404);
            }
            return redirect()->back()->with('error', 'Notificação não encontrada');
        }
        
        $this->notificationService->markAsRead($id);
        
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notificação marcada como lida',
            ]);
        }
        
        return redirect()->back()->with('success', 'Notificação marcada como lida');
    }

    /**
     * Marcar todas como lidas
     */
    public function markAllAsRead()
    {
        $count = $this->notificationService->markAllAsRead(Auth::id());
        
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "$count notificações marcadas como lidas",
                'count' => $count,
            ]);
        }
        
        return redirect()->back()->with('success', "$count notificações marcadas como lidas");
    }

    /**
     * Contar não lidas (API)
     */
    public function count()
    {
        $count = $this->notificationService->countUnread(Auth::id());
        
        return response()->json([
            'success' => true,
            'count' => $count,
        ]);
    }
}
