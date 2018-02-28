<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LiderDoEscritorioDeProjetos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//if ($request->user()->isLiderEscritProjetos($request->user()->id) == false) {
           // $code = [403];
			//$error = array( 'error' => 'Acesso nao autorizado', 'code' => $code);
			//return view('/common.403', $error, $code);
        //}
       return $next($request); #---------------------------Unica original

    }
}
