<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            session()->flash('status', 'Siz admin bo\'limidasiz.');
        } elseif ($user->hasRole('writer')) {
            session()->flash('status', 'Siz yozuvchi bo\'limidasiz.');
        } else {
            session()->flash('status', 'Sizning so\'rovingiz adminga yuborildi.');
        }

        return $next($request);
    }
}
