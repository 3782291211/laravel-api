<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $actions = ['view-exams', 'view-users', 'create-exam', 'update-exam', 'delete-exam'];
        foreach ($actions as $action)
        {
            if ($action === 'update-exam' || $action === 'delete-exam') {
                Gate::define($action, fn (User $user, int $candidateId) => 
                    $user->id === $candidateId || Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
                );
            } else {
                Gate::define($action, fn (User $user) => 
                    Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
                );
            }
        }
        
        /*Gate::define('view-exams', fn (User $user) => 
            Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
        );

        Gate::define('view-users', fn (User $user) => 
            Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
        );

        Gate::define('create-exam', fn (User $user) => 
            Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
        );

        Gate::define('update-exam', fn (User $user, int $candidateId) => 
            $user->id === $candidateId || Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
        );

        Gate::define('delete-exam', fn (User $user, int $candidateId) => 
            $user->id === $candidateId || Str::of($user->email)->endsWith('@v3.admin') ? Response::allow() : Response::deny()
        );*/
    }
}
