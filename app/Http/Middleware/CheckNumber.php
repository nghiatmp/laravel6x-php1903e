<?php

namespace App\Http\Middleware;

use Closure;

class CheckNumber
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
        $number = $request->number;
        if($number %2 != 0 ){
            return redirect()->route('nan');
        }
        return $next($request);
    }
}
