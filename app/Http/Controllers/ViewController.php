<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
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
}
