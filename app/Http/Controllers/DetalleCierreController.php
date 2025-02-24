<?php

namespace App\Http\Controllers;

use App\Models\DetalleCierre;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCierreController extends Controller
{
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
        $producto = Producto::where('codigo',$request->codigo)->first();

        $id_cierre = $request->id_cierre;

        if($producto){

            $detalle_cierre_existe = DetalleCierre::where('producto_id',$producto->id)
                ->where('cierre_id',$id_cierre)
                ->first();

            if($detalle_cierre_existe){
                $detalle_cierre_existe->cantidad += $request->cantidad;
                $detalle_cierre_existe->save();
                return response()->json(['success'=>true,'message'=>'Producto encontrado']);
            }else{

                $detalle_cierre = new DetalleCierre();
                $detalle_cierre->cantidad = $request->cantidad;
                $detalle_cierre->precio_compra = '0';
                $detalle_cierre->ganancia = '0';
                $detalle_cierre->precio_total = '0';
                $detalle_cierre->precio_venta = '0';
                $detalle_cierre->producto_id = $producto->id;
                $detalle_cierre->cierre_id = $id_cierre;
                $detalle_cierre->save();

                return response()->json(['success'=>true,'message'=>'Producto encontrado']);

            }


        }else{
            return response()->json(['success'=>false,'message'=>'Producto no encontrado']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleCierre $detalleCierre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleCierre $detalleCierre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleCierre $detalleCierre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DetalleCierre::destroy($id);
        return response()->json(['success'=>true]);
    }
}
