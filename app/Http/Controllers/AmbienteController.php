<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ambiente;

class AmbienteController extends Controller
{
    /**
     * Mostrar una lista de todos los ambientes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return response()->json($ambientes);
    }

    /**
     * Almacenar un nuevo ambiente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $ambiente = Ambiente::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Ambiente creado exitosamente',
            'ambiente' => $ambiente
        ], 201);
    }

    /**
     * Mostrar un ambiente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }

        return response()->json($ambiente);
    }

    /**
     * Actualizar un ambiente existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }

        $ambiente->nombre = $request->nombre;
        $ambiente->save();

        return response()->json([
            'message' => 'Ambiente actualizado exitosamente',
            'ambiente' => $ambiente
        ]);
    }

    /**
     * Eliminar un ambiente existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }

        $ambiente->delete();

        return response()->json(['message' => 'Ambiente eliminado exitosamente']);
    }
}
