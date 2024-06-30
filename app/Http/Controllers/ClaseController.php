<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clase;

class ClaseController extends Controller
{
    /**
     * Muestra una lista de todas las clases.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clases = Clase::all();
        return response()->json($clases);
    }

    /**
     * Almacena una nueva clase en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'clase_mantenimiento' => 'required|string|max:255',
        ]);

        $clase = Clase::create([
            'clase_mantenimiento' => $request->clase_mantenimiento,
        ]);

        return response()->json([
            'message' => 'Clase creada exitosamente',
            'clase' => $clase,
        ], 201);
    }

    /**
     * Muestra una clase específica.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(Clase $clase)
    {
        return response()->json($clase);
    }

    /**
     * Actualiza una clase específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        $request->validate([
            'clase_mantenimiento' => 'required|string|max:255',
        ]);

        $clase->clase_mantenimiento = $request->clase_mantenimiento;
        $clase->save();

        return response()->json([
            'message' => 'Clase actualizada exitosamente',
            'clase' => $clase
        ]);
    }

    /**
     * Elimina una clase específica.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        $clase->delete();

        return response()->json([
            'message' => 'Clase eliminada exitosamente'
        ]);
    }
}
