<?php
namespace App\Http\Responses;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Log;
class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // dd(auth()->user());
        if(auth()->user()->utype == 'ADMIN'){
            Log::info('administradorrrr'); 
            $home = '/admin';
        } elseif(auth()->user()->utype == 'USER'){
            Log::info('usuariooooo'); 
            $home = '/catalogo';
        }
        Log::info($home);
        return redirect()->to($home);
    }
}