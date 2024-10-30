<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function checkRole()
    {
        $user = Auth::User();

        if($user -> hasRole("Administrador")){
            return 'El usuario tiene el rol de admin';
        }else{
            return 'El usuario NO tiene el rol de admin';
        }
    }
}
