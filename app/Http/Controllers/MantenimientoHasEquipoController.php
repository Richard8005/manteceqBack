<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MantenimientoHasEquipo;


class MantenimientoHasEquipoController extends Controller
{
    /**
     * Muestra una lista de todos los mantenimientos con equipos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimientoHasEquipos = MantenimientoHasEquipo::with(['mantenimiento', 'equipo'])->get();
        return response()->json($mantenimientoHasEquipos);
    }

    /**
     * Almacena una nueva relación entre mantenimiento y equipo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'equipo_codigo_inventario' => 'required|exists:equipos,codigo_inventario',
        ]);

        $mantenimientoHasEquipo = MantenimientoHasEquipo::create([
            'mantenimiento_id' => $request->mantenimiento_id,
            'equipo_codigo_inventario' => $request->equipo_codigo_inventario,
        ]);

        return response()->json([
            'message' => 'Relación entre mantenimiento y equipo creada exitosamente',
            'mantenimientoHasEquipo' => $mantenimientoHasEquipo,
        ], 201);
    }

    /**
     * Muestra una relación específica entre mantenimiento y equipo.
     *
     * @param  int  $mantenimiento_id
     * @param  string  $equipo_codigo_inventario
     * @return \Illuminate\Http\Response
     */
    public function show($mantenimiento_id, $equipo_codigo_inventario)
    {
        $mantenimientoHasEquipo = MantenimientoHasEquipo::where('mantenimiento_id', $mantenimiento_id)
            ->where('equipo_codigo_inventario', $equipo_codigo_inventario)
            ->first();

        if (!$mantenimientoHasEquipo) {
            return response()->json(['message' => 'Relación no encontrada'], 404);
        }

        return response()->json($mantenimientoHasEquipo);
    }

    /**
     * Actualiza una relación específica entre mantenimiento y equipo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $mantenimiento_id
     * @param  string  $equipo_codigo_inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mantenimiento_id, $equipo_codigo_inventario)
    {
        $request->validate([
            'mantenimiento_id' => 'required|exists:mantenimientos,id',
            'equipo_codigo_inventario' => 'required|exists:equipos,codigo_inventario',
        ]);

        $mantenimientoHasEquipo = MantenimientoHasEquipo::where('mantenimiento_id', $mantenimiento_id)
            ->where('equipo_codigo_inventario', $equipo_codigo_inventario)
            ->first();

        if (!$mantenimientoHasEquipo) {
            return response()->json(['message' => 'Relación no encontrada'], 404);
        }

        $mantenimientoHasEquipo->update([
            'mantenimiento_id' => $request->mantenimiento_id,
            'equipo_codigo_inventario' => $request->equipo_codigo_inventario,
        ]);

        return response()->json([
            'message' => 'Relación actualizada exitosamente',
            'mantenimientoHasEquipo' => $mantenimientoHasEquipo,
        ]);
    }

    /**
     * Elimina una relación específica entre mantenimiento y equipo.
     *
     * @param  int  $mantenimiento_id
     * @param  string  $equipo_codigo_inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy($mantenimiento_id, $equipo_codigo_inventario)
    {
        $mantenimientoHasEquipo = MantenimientoHasEquipo::where('mantenimiento_id', $mantenimiento_id)
            ->where('equipo_codigo_inventario', $equipo_codigo_inventario)
            ->first();

        if (!$mantenimientoHasEquipo) {
            return response()->json(['message' => 'Relación no encontrada'], 404);
        }

        $mantenimientoHasEquipo->delete();

        return response()->json([
            'message' => 'Relación eliminada exitosamente'
        ]);
    }
}
