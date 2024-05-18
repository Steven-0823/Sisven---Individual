<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        $categorias = DB::table('categories')->get();
        return json_encode(['categorias' => $categorias]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $categoria = new Categoria();

        // $categoria -> name = $request -> name;
        // $categoria -> description = $request-> description;
        // $categoria->save();

        // return json_encode(['categorias' => $categorias]);

        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:30', 'unique:categorias'],
            'description' => ['required', 'max:255']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'statusCode' => 400
            ]);
        }
        $categoria = new Categoria();
        $categoria->name = $request->name;
        $categoria->description = $request->description;
        $categoria->save();

        return json_encode(['categorias' => $categorias]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        if(is_null($categoria))
        {
            return abort(400);
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);
        $categoria -> name = $request -> name;
        $categoria -> description = $request-> description;
        $categoria ->  save();

        $categorias = DB::table('categories')
        ->orderBy('name')
        ->get();
        return json_encode ( ['categorias' => $categorias]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        $categorias = DB::table('categories')
        ->orderBy('name')
        ->get();

        return json_encode ( ['categorias' => $categorias]);
    }
}
