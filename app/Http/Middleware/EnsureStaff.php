<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->is_active || ! $user->isStaff()) {
            return redirect()
                ->route('home')
                ->withErrors(['auth' => 'Anda tidak memiliki akses ke panel admin.']);
        }

        return $next($request);
    }
}
