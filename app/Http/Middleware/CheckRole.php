<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if(in_array($request->user()->hak_akses,$roles)){
            return $next($request);
        }

        return redirect()->back()->with('warning', 'Maaf, anda tidak punya akses untuk modul tersebut...!');
    }
}
