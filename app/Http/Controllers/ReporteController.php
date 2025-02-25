<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Reporte;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function repproducto()
    {
        $empresa = Empresa::where('id',Auth::user()->empresa_id)->first();
        $productos = Producto::where('empresa_id',Auth::user()->empresa_id)->get();
        $rep_pro = PDF::loadView('admin.reportes.re_producto', compact('empresa','productos'));
        return $rep_pro->download('Inventario.pdf');
    }

    public  function repventa($id)
    {
        $empresa = Empresa::where('id',Auth::user()->empresa_id)->first();
        $venta = Venta::with('detallesventa','cliente')->findOrFail($id);
        $cliente = $venta->cliente;
        $rep_venta = PDF::loadView('admin.reportes.reventa', compact('empresa','venta'));
        return $rep_venta->download('Venta_de_'.$cliente->nombre_cliente.'.pdf');
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
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
