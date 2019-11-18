<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$params = null)
    {
        // dd($params);
        //$params bien de nhan gia tri truyen vao tu ben ngoai middleware
        //xu ly logic thong qua tham so nay
        // $myAge = $request->age;
        // if($myAge < 18 && $params !== 'admin'){
        //     return redirect()->route('film2');
        // }
        // return $next($request);




        //after  middleware 
        $respone = $next($request);
         $myAge = $request->age;
        if($myAge < 18 && $params !== 'admin'){
            return redirect()->route('film2');
        }

        return $respone;

    }
}
