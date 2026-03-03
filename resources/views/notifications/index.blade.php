@extends('layouts.modern')

@section('title', 'Notificações')

@section('content')
<div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold">Notificações</h1>
                <p class="text-primary-100 mt-1">{{ $count > 0 ? $count . ' não lida(s)' : 'Sem notificações novas' }}</p>
            </div>
            @if($count > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-white text-primary-600 hover:bg-primary-50 px-4 py-2 rounded-lg font-semibold transition duration-200">
                        <i class="fas fa-check-double mr-2"></i> Marcar todas como lidas
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">{{ session('success') }}</div>
    @endif

    @if($notifications->isEmpty())
        <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500">
            <i class="fas fa-bell-slash text-4xl mb-4 text-gray-300"></i>
            <p class="text-lg">Não tem notificações novas.</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($notifications as $notification)
                @php
                    $data = is_array($notification->data) ? $notification->data : (json_decode($notification->data, true) ?? []);
                    $title = $data['title'] ?? 'Notificação';
                    $message = $data['message'] ?? '';
                    $url = $data['url'] ?? '#';
                    $icon = $data['icon'] ?? 'fa-bell';
                @endphp
                <div class="bg-white shadow-md rounded-lg p-4 flex items-start gap-4 hover:shadow-lg transition-shadow">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ $url }}" class="block group">
                            <h3 class="font-semibold text-gray-900 group-hover:text-primary-600">{{ $title }}</h3>
                            @if($message)
                                <p class="text-gray-600 text-sm mt-1">{{ $message }}</p>
                            @endif
                            <span class="text-xs text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                    </div>
                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-primary-600 p-2" title="Marcar como lida">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
