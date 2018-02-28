<?php

namespace App\Http\Middleware;

use Closure;

class AdministradorVerificar
{
	/*
    |--------------------------------------------------------------------------
    | Middleware AdministradorVerificar			04/08/2017 14:30
    |--------------------------------------------------------------------------
    |
    | Este Middleware é usado para a autenticação e controle de rotas do Admin
    | usadas para a criação , registro e administração de usuários.
    |
    */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//var_dump($request->user());

		//if (! $request->user()->hasRole($role)) {
            // Redirect...
        //}
		
        return $next($request);
    }
}
