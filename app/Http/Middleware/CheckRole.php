<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Cek jika user punya role menggunakan Spatie Permission
        if (!$user->hasAnyRole($roles)) {
            return abort(403, 'Unauthorized. No role assigned.');
        }

        return $next($request);
    }
}
