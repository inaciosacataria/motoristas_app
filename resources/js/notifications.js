/**
 * Sistema de Notificações em Tempo Real
 */

class NotificationSystem {
    constructor() {
        this.pollInterval = 30000; // 30 segundos
        this.notificationBell = document.querySelector('.notification-bell');
        this.notificationBadge = document.querySelector('.notification-badge');
        this.notificationDropdown = document.querySelector('.notification-dropdown');
        
        this.init();
    }

    init() {
        // Iniciar polling de notificações
        this.startPolling();
        
        // Event listeners
        this.setupEventListeners();
        
        // Carregar notificações iniciais
        this.loadNotifications();
    }

    startPolling() {
        setInterval(() => {
            this.loadNotifications();
        }, this.pollInterval);
    }

    setupEventListeners() {
        // Marcar como lida ao clicar
        document.addEventListener('click', (e) => {
            if (e.target.closest('.notification-item')) {
                const notificationId = e.target.closest('.notification-item').dataset.id;
                this.markAsRead(notificationId);
            }
        });

        // Marcar todas como lidas
        const markAllBtn = document.querySelector('.mark-all-read');
        if (markAllBtn) {
            markAllBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.markAllAsRead();
            });
        }
    }

    async loadNotifications() {
        try {
            const response = await fetch('/api/notifications/unread', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('Erro ao carregar notificações');

            const data = await response.json();
            
            if (data.success) {
                this.updateBadge(data.count);
                this.renderNotifications(data.notifications);
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    }

    updateBadge(count) {
        if (this.notificationBadge) {
            if (count > 0) {
                this.notificationBadge.textContent = count > 9 ? '9+' : count;
                this.notificationBadge.classList.remove('hidden');
            } else {
                this.notificationBadge.classList.add('hidden');
            }
        }
    }

    renderNotifications(notifications) {
        if (!this.notificationDropdown) return;

        if (notifications.length === 0) {
            this.notificationDropdown.innerHTML = `
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-bell-slash text-4xl mb-2"></i>
                    <p>Nenhuma notificação</p>
                </div>
            `;
            return;
        }

        const html = notifications.map(notification => {
            const data = notification.data;
            return `
                <a href="${data.url}" 
                   class="notification-item block p-4 hover:bg-gray-50 transition-colors border-b border-gray-100"
                   data-id="${notification.id}">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <i class="fas ${data.icon} text-primary-600 text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 text-sm">${data.title}</p>
                            <p class="text-gray-600 text-sm mt-1">${data.message}</p>
                            <p class="text-gray-400 text-xs mt-1">${this.formatDate(notification.created_at)}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="w-2 h-2 bg-primary-600 rounded-full block"></span>
                        </div>
                    </div>
                </a>
            `;
        }).join('');

        this.notificationDropdown.innerHTML = html + `
            <div class="p-3 bg-gray-50 text-center">
                <button class="mark-all-read text-primary-600 hover:text-primary-700 text-sm font-medium">
                    Marcar todas como lidas
                </button>
            </div>
        `;
    }

    async markAsRead(notificationId) {
        try {
            const response = await fetch(`/api/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('Erro ao marcar como lida');

            const data = await response.json();
            
            if (data.success) {
                this.loadNotifications();
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    }

    async markAllAsRead() {
        try {
            const response = await fetch('/api/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('Erro ao marcar todas como lidas');

            const data = await response.json();
            
            if (data.success) {
                this.loadNotifications();
                showToast('Todas as notificações foram marcadas como lidas', 'success');
            }
        } catch (error) {
            console.error('Erro:', error);
            showToast('Erro ao marcar notificações como lidas', 'error');
        }
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = now - date;
        const seconds = Math.floor(diff / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 7) {
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric' 
            });
        }
        if (days > 0) return `há ${days} dia${days > 1 ? 's' : ''}`;
        if (hours > 0) return `há ${hours} hora${hours > 1 ? 's' : ''}`;
        if (minutes > 0) return `há ${minutes} minuto${minutes > 1 ? 's' : ''}`;
        return 'agora mesmo';
    }
}

// Inicializar quando o DOM estiver pronto
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new NotificationSystem();
    });
} else {
    new NotificationSystem();
}

