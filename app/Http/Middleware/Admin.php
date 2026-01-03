<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Proverite da li je korisnik ulogovan
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Proverite da li je korisnik admin
        // Prilagodite ovu logiku prema vašem sistemu uloga
        if (Auth::user()->role !== 'admin') {
            // Ako nije admin, preusmerite ga sa porukom o grešci
            return redirect()->route('home')->with('error', 'Nemate pristup ovoj stranici.');
        }

        return $next($request);
    }
}