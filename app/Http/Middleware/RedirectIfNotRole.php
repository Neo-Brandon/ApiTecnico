<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)//: Response
    {
        // Verificar primero la autenticacion del usuario, para no tener dos middlewares
        if (!Auth::check()){
            return redirect(('/login'));
        }

        $user = Auth::user();

        // Redireccion segun el rol del usuario
        if ($user->hasRole($role)) {
            if ($role == 'Administrador'){
                return redirect('admin.index');
            }elseif ($role == 'Tecnico'){
                return redirect('tecnico.index');
            }
        }
        //Ahora, si no tiene rol, redirigir al lugar por defecto
        return $next($request);
    }
}
