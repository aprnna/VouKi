<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isOrganizer', fn(User $user) => $user->role === 'organizer');
        Gate::define('OrganizeEvent', fn(User $user, Event $event) => $user->role === 'organizer' && $event->organizer_id === $user->id);
    }
}
