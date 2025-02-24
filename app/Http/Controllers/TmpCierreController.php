<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TmpCierre;
use Illuminate\Http\Request;

class TmpCierreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function tmp_cierres(Request $request)
    {
        $producto = Producto::where('codigo',$request->codigo)->first();

        $session_id = session()->getId();

        if($producto){

            $tmp_cierre_existe = TmpCierre::where('producto_id',$producto->id)
                ->where('session_id',$session_id)
                ->first();

            if($tmp_cierre_existe){
                $tmp_cierre_existe->cantidad += $request->cantidad;
                $tmp_cierre_existe->save();
                return response()->json(['success'=>true,'message'=>'Producto encontrado']);
            }else{

                $tmp_cierre = new TmpCierre();
                $tmp_cierre->cantidad = $request->cantidad;
                $tmp_cierre->producto_id = $producto->id;
                $tmp_cierre->session_id = session()->getId();
                $tmp_cierre->save();

                return response()->json(['success'=>true,'message'=>'Producto encontrado']);

            }


        }else{
            return response()->json(['success'=>false,'message'=>'Producto no encontrado']);
        }
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
    public function show(TmpCierre $tmpCierre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpCierre $tmpCierre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpCierre $tmpCierre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TmpCierre::destroy($id);
        return response()->json(['success'=>true,'message'=>'Producto eliminado']);
    }
}
