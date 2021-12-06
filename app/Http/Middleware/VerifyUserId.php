<?php

namespace App\Http\Middleware;

use App\Models\GeneralOrder;
use Closure;
use Illuminate\Http\Request;

class VerifyUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->route('id'));
        $orden = GeneralOrder::where('id', $request->route('id'))->get();
        if(auth()->user()->id == $orden[0]->id_usuario){
            return $next($request);
        } else {
            return route('user.orders');
        }
    }
}
