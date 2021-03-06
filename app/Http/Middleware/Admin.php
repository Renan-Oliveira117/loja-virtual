<?php

namespace App\Http\Middleware;

use Closure;

class Admin

{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->admin == 1){
            return $next($request);
        }

        return redirect('/')->with('error', "Sem permissão para acessar essa página");
    }
}