<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Arahkan ke halaman login jika belum login
        }

        // Periksa peran pengguna
        if (($user->role == 'admin') ||
            ($user->role == 'karyawan') ||
            ($user->role == 'pelanggan')
        ) {
            return $next($request);
        }

        return redirect()->route('dashboard.index'); // Arahkan jika tidak memiliki akses
    }
}
