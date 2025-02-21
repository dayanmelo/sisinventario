<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tmpcompra;
use Illuminate\Http\Request;

class TmpcompraController extends Controller
{

    public function tmp_compras(Request $request)
    {
        $producto = Producto::where('codigo',$request->codigo)->first();

        $session_id = session()->getId();

        if($producto){

            $tmp_compra_existe = Tmpcompra::where('producto_id',$producto->id)
                ->where('session_id',$session_id)
                ->first();

            if($tmp_compra_existe){
                $tmp_compra_existe->cantidad += $request->cantidad;
                $tmp_compra_existe->save();
                return response()->json(['success'=>true,'message'=>'Producto encontrado']);
            }else{

                $tmp_compra = new Tmpcompra();
                $tmp_compra->cantidad = $request->cantidad;
                $tmp_compra->producto_id = $producto->id;
                $tmp_compra->session_id = session()->getId();
                $tmp_compra->save();

                return response()->json(['success'=>true,'message'=>'Producto encontrado']);

            }


        }else{
            return response()->json(['success'=>false,'message'=>'Producto no encontrado']);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tmpcompra $tmpcompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tmpcompra $tmpcompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tmpcompra $tmpcompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tmpcompra::destroy($id);
        return response()->json(['success'=>true,'message'=>'Producto eliminado']);
    }
}
