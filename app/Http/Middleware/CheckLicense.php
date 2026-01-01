<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckLicense
{
    public function handle(Request $request, Closure $next)
    {
        // On récupère la valeur de la table secrète
        $config = DB::table('site_configs')->where('key', 'is_active')->first();

        // Si la valeur est 'OFF', on bloque tout sauf les fichiers statiques
        if ($config && $config->value === 'OFF') {
            return response()->view('errors.suspended', [], 403);
        }

        return $next($request);
    }
}