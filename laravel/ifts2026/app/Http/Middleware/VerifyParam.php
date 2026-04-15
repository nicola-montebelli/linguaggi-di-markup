<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class VerifyParam
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::debug('Verifica del parametro ifts. '.$request->input('ifts') ?? null);
        if($request->input('ifts') !== 'ifts2026')
            {
                return response()->json([
                    'message' => 'Middleware VerifyParam ha bloccato l\'accesso',
                ], 403);
            };
        return $next($request);     
    }
}
//in postman se facciamo una send senza la key ci verrà dato il messaggio "middleware ha bloccato l'accesso"
//se facciamo una send con la key ifts2026 allora ci ritornerà quello che cerchiamo