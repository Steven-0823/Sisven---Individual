<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        return response()->json(['productos' => $productos], 200);
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->name = $request->name;
        $producto->price = $request->price;
        $producto->stock = $request->stock;
        $producto->category_id = $request->category_id;
        $producto->save();

        return response()->json(['producto' => $producto], 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        return response()->json(['producto' => $producto], 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->name = $request->name;
        $producto->price = $request->price;
        $producto->stock = $request->stock;
        $producto->category_id = $request->category_id;
        $producto->save();

        return response()->json(['producto' => $producto], 200);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (is_null($producto)) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->delete();

        return response()->json(['mensaje' => 'Producto eliminado correctamente'], 200);
    }
}
