<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{


    public function index()
{
    // Acessa a view auth/perfil.blade.php
    return view('auth.perfil');
}

}
