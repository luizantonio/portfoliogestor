<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LiderProjetoMiddleware
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
		/* Gera erro nos outros Middleware
		 * (1/1) FatalThrowableError
		 * Call to a member function setCookie() on null
		 * in VerifyCsrfToken.php (line 156)
		 */
		/*if ($request->user()->isLiderProjetos($request->user()->id) == 0) {
            $code = [403];
			$error = array( 'error' => 'Acesso nao autorizado', 'code' => $code);
			return view('/common.403', $error, $code);
        }
		*/
		return $next($request); #---------------------------Unica original

    }
}
