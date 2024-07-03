<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:view permission')->only('rolesPermisos');
        // $this->middleware('can:view usuarios')->only('usuarios');
        // $this->middleware('can:view estudiante')->only('estudiante');
        // $this->middleware('can:view docentes')->only('docentes');
    }

    // Gestion
    public function index()
    {
        $caso = 'dashboard';
        return view('livewire.dashboard', compact('caso'));
    }

    public function rolesPermisos()
    {
        $caso = 'rolesPermisos';
        return view('livewire.dashboard', compact('caso'));
    }

    public function usuarios()
    {
        $caso = 'usuarios';
        return view('livewire.dashboard', compact('caso'));
    }

    public function estudiante()
    {
        $caso = 'estudiante';
        return view('livewire.dashboard', compact('caso'));
    }

    public function docentes()
    {
        $caso = 'docentes';
        return view('livewire.dashboard', compact('caso'));
    }

    // Sistema de Votacion

    public function panelVotacion()
    {
        $caso = 'panelVotacion';
        return view('livewire.dashboard', compact('caso'));
    }

    public function historialVotacion()
    {
        $caso = 'historialVotacion';
        return view('livewire.dashboard', compact('caso'));
    }

    public function postulacion()
    {
        $caso = 'postulacion';
        return view('livewire.dashboard', compact('caso'));
    }


}
