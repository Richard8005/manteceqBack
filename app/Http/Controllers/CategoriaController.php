<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de todas las categorías.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    /**
     * Almacena una nueva categoría en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:15',
        ]);

        $categoria = Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'message' => 'Categoría creada exitosamente',
            'categoria' => $categoria,
        ], 201);
    }

    /**
     * Muestra una categoría específica.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return response()->json($categoria);
    }

    /**
     * Actualiza una categoría específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:15',
        ]);

        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
            'message' => 'Categoría actualizada exitosamente',
            'categoria' => $categoria
        ]);
    }

    /**
     * Elimina una categoría específica.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json([
            'message' => 'Categoría eliminada exitosamente'
        ]);
    }
}