<?php

namespace App\Http\Middleware;


use Closure;

class CheckOption
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
       $deger = \App\Option::where('key','kayit_durum')->first();
       if($deger->value === '1')
       {
            return $next($request);
       }
       else
       {
            return redirect('/yetkiyok');
            //return $next($)
       }
        
    }
}
