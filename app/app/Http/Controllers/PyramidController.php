<?php
// app/Http/Controllers/PyramidController.php

namespace App\Http\Controllers;

use App\Services\PyramidService;
use Illuminate\Http\Request;

/**
 * Controlador para manejar las peticiones de la pirámide
 * 
 * @package App\Http\Controllers
 */
class PyramidController extends Controller
{
    protected $pyramidService;

    /**
     * Constructor
     *
     * @param PyramidService $pyramidService
     */
    public function __construct(PyramidService $pyramidService)
    {
        $this->pyramidService = $pyramidService;
    }

    /**
     * Muestra el formulario para ingresar el número
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('piramide');
    }

    /**
     * Genera y muestra la pirámide
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function genera(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer|min:1|max:9',
            'filas' => 'sometimes|integer|min:1|max:20'
        ]);

        $numBase = $request->input('numero');
        $filas = $request->input('filas', 10);

        $piramide = $this->pyramidService->generaPiramide($numBase, $filas);

        return view('piramide', [
            'piramide' => $piramide,
            'numBase' => $numBase,
            'filas' => $filas
        ]);
    }
}