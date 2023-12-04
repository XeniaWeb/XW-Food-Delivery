<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        /** @var User $user */
        $user = Auth::guard()->user();

        $roles = $user->roles()
            ->pluck('name')
            ->toArray();

        if (!in_array($role, $roles)) {
            return redirect('/');
        }

        return $next($request);
    }
}
