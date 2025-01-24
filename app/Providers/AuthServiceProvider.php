<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Event;
use App\Models\EventStatus;
use App\Models\Favorite;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\EventPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Event::class => EventPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-ticket', function(User $user, Ticket $ticket) {
            return $user->id === $ticket->user_id;
        });

        Gate::define('buy-ticket-on-event', function(User $user, Event $event) {
            return $event->event_status_id === EventStatus::ACTIVE_STATUS;
        });

        Gate::define('cancel-ticket', function(User $user, Ticket $ticket) {
            return $user->id === $ticket->user_id && $ticket->status === Ticket::PAID_STATUS;
        });

        Gate::define('view-organizer-info', function(User $user) {
            return $user->role === User::ROLE_ORGANIZER;
        });

        Gate::define('set-manager-fields-for-events', function(User $user) {
            return $user->role === User::ROLE_MANAGER;
        });

        Gate::define('destroy-favorite', function(User $user, Favorite $favorite) {
            return $user->id === $favorite->user_id;
        });

        Gate::define('inspector-update-ticket', function(User $user, Ticket $ticket) {
            return $user->role === User::ROLE_INSPECTOR && $ticket->status === Ticket::PAID_STATUS;
        });

        Gate::define('view-panel', function(User $user) {
            return ($user->role === User::ROLE_ORGANIZER && $user->organizer->approved) ||
                $user->role === User::ROLE_MANAGER ||
                $user->role === User::ROLE_ADMIN;
        });
    }
}
