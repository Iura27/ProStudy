<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

class HorariosController extends Controller
{
    public function index() {
        $horarios = Horario::All();
        return view('horarios', ['horarios'=>$horarios]);
    }
}
