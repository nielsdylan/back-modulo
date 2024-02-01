<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    public function lista() {
        $data = User::all();
        return response()->json($data,200);
    }
}
