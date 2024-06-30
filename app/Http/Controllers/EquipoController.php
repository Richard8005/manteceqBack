<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipo;

class EquipoController extends Controller
{
    /**
     * Muestra una lista de todos los equipos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::all();
        return response()->json($equipos);
    }

    /**
     * Almacena un nuevo equipo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_inventario' => 'required|string|unique:equipos,codigo_inventario',
            'user_id' => 'required|exists:users,id',
            'ambiente_id' => 'required|exists:ambientes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'marca' => 'required|string|max:50',
            'aceptacion_cuentadancia' => 'required|integer|between:0,1',
        ]);

        $equipo = Equipo::create([
            'codigo_inventario' => $request->codigo_inventario,
            'user_id' => $request->user_id,
            'ambiente_id' => $request->ambiente_id,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'marca' => $request->marca,
            'aceptacion_cuentadancia' => $request->aceptacion_cuentadancia,
        ]);

        return response()->json([
            'message' => 'Equipo creado exitosamente',
            'equipo' => $equipo,
        ], 201);
    }

    /**
     * Muestra un equipo específico.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        return response()->json($equipo);
    }

    /**
     * Actualiza un equipo específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'codigo_inventario' => 'required|string|unique:equipos,codigo_inventario,' . $equipo->codigo_inventario . ',codigo_inventario',
            'user_id' => 'required|exists:users,id',
            'ambiente_id' => 'required|exists:ambientes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'marca' => 'required|string|max:50',
            'aceptacion_cuentadancia' => 'required|integer|between:0,1',
        ]);

        $equipo->update([
            'codigo_inventario' => $request->codigo_inventario,
            'user_id' => $request->user_id,
            'ambiente_id' => $request->ambiente_id,
            'categoria_id' => $request->categoria_id,
            'descripcion' => $request->descripcion,
            'marca' => $request->marca,
            'aceptacion_cuentadancia' => $request->aceptacion_cuentadancia,
        ]);

        return response()->json([
            'message' => 'Equipo actualizado exitosamente',
            'equipo' => $equipo
        ]);
    }

    /**
     * Elimina un equipo específico.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return response()->json([
            'message' => 'Equipo eliminado exitosamente'
        ]);
    }
}
