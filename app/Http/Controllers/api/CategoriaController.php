<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return json_encode(['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $categoria = new Categoria();
        $categoria->name = $request->name;
        $categoria->description = $request->description;
        $categoria->save();

        return  json_encode(['categoria' => $categoria]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $categoria = Categoria::find($id);
        return json_encode(['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        

        $categoria = Categoria::find($id);
        $categoria->name = $request->name;
        $categoria->description = $request->description;
        $categoria->save();

        return json_encode(['categoria' => $categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        $categorias = DB::table('categories')
        ->orderBy('name')
        ->get();

        return json_encode(['categoria' => $categoria]);
    }
}
