<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->input('user') !=='ifts' || $request->input('password') !=='2026'){
            return response()->json([
                    'message' => 'Accesso Negato',
                ], 401);
        };
        return $next($request);
    }
}
//se in postman facciamo una qualsiasi richiesta (vedi file api.php) senza inserire come parametri user e password (che in questo caso hanno solo i valori
//user = ifts e password = 2026) ci darà errore 401 Accesso Negato. Se facendo una richiesta inseriamo quei parametri allora verrà soddisfatta la richiesta