<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mantenimiento;

class MantenimientoController extends Controller
{
    /**
     * Muestra una lista de todos los mantenimientos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        return response()->json($mantenimientos);
    }

    /**
     * Almacena un nuevo mantenimiento en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'clase_id' => 'required|exists:clases,id',
            'estado' => 'required|string|max:255',
            'descripcion_solicitud' => 'required|string',
            'fecha_solicitud' => 'required|date',
            'fecha_aceptacion' => 'required|date',
            'descripcion_ejecucion' => 'required|string',
            'fecha_ejecucion' => 'required|date',
            'costo' => 'required|string',
            'fecha_finalizacion' => 'required|date',
        ]);

        $mantenimiento = Mantenimiento::create([
            'clase_id' => $request->clase_id,
            'estado' => $request->estado,
            'descripcion_solicitud' => $request->descripcion_solicitud,
            'fecha_solicitud' => $request->fecha_solicitud,
            'fecha_aceptacion' => $request->fecha_aceptacion,
            'descripcion_ejecucion' => $request->descripcion_ejecucion,
            'fecha_ejecucion' => $request->fecha_ejecucion,
            'costo' => $request->costo,
            'fecha_finalizacion' => $request->fecha_finalizacion,
        ]);

        return response()->json([
            'message' => 'Mantenimiento creado exitosamente',
            'mantenimiento' => $mantenimiento,
        ], 201);
    }

    /**
     * Muestra un mantenimiento específico.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
        return response()->json($mantenimiento);
    }

    /**
     * Actualiza un mantenimiento específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $request->validate([
            'clase_id' => 'required|exists:clases,id',
            'estado' => 'required|string|max:255',
            'descripcion_solicitud' => 'required|string',
            'fecha_solicitud' => 'required|date',
            'fecha_aceptacion' => 'required|date',
            'descripcion_ejecucion' => 'required|string',
            'fecha_ejecucion' => 'required|date',
            'costo' => 'required|string',
            'fecha_finalizacion' => 'required|date',
        ]);

        $mantenimiento->update([
            'clase_id' => $request->clase_id,
            'estado' => $request->estado,
            'descripcion_solicitud' => $request->descripcion_solicitud,
            'fecha_solicitud' => $request->fecha_solicitud,
            'fecha_aceptacion' => $request->fecha_aceptacion,
            'descripcion_ejecucion' => $request->descripcion_ejecucion,
            'fecha_ejecucion' => $request->fecha_ejecucion,
            'costo' => $request->costo,
            'fecha_finalizacion' => $request->fecha_finalizacion,
        ]);

        return response()->json([
            'message' => 'Mantenimiento actualizado exitosamente',
            'mantenimiento' => $mantenimiento
        ]);
    }

    /**
     * Elimina un mantenimiento específico.
     *
     * @param  \App\Models\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return response()->json([
            'message' => 'Mantenimiento eliminado exitosamente'
        ]);
    }
}
