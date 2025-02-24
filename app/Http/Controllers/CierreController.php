<?php

namespace App\Http\Controllers;

use App\Models\Cierre;
use App\Models\DetalleCierre;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\TmpCierre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CierreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cierres = Cierre::with('detallescierre')->get();
        return view('admin.cierres.index', compact('cierres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id',Auth::user()->empresa_id)->get();
        $session_id = session()->getId();
        $tmp_cierres = TmpCierre::where('session_id',$session_id)->get();
        return view('admin.cierres.create', compact('productos',  'tmp_cierres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*$dato = Request()->all();
        return response()->json($dato);*/
        $request->validate([
            'fecha' => 'required',
            'total' => 'required',
            'ganancia' => 'required',
        ]);

        //$detalle_compra = $request->precio_compra;
        //return response()->json($detalle_compra);

        $session_id = session()->getId();
        $preciosCompra = $request->precio_compra;
        $preciosVenta = $request->precio_venta;

        $cierre = new Cierre();
        $cierre->fecha = $request->fecha;
        $cierre->precio_total = $request->total;
        $cierre->ganancia = $request->ganancia;
        $cierre->empresa_id = Auth::user()->empresa_id;
        $cierre->save();

        $tmp_cierres = TmpCierre::where('session_id',$session_id)->get();
        foreach ($tmp_cierres as $index => $tmp_cierre) {

            $producto = Producto::where('id', $tmp_cierre->producto_id)->first();

            $detalle_cierre = new DetalleCierre();
            $detalle_cierre->cantidad = $tmp_cierre->cantidad;
            if (isset($preciosCompra[$index]) && isset($preciosVenta[$index])) {
                $detalle_cierre->precio_compra = $preciosCompra[$index]; // Asigna el precio individual
                $detalle_cierre->precio_venta = $preciosVenta[$index];
                $detalle_cierre->precio_total = $preciosVenta[$index] * $tmp_cierre->cantidad;
                $detalle_cierre->ganancia = ($preciosVenta[$index] - $preciosCompra[$index])* $tmp_cierre->cantidad;
            }
            $detalle_cierre->cierre_id = $cierre->id;

            $detalle_cierre->producto_id = $tmp_cierre->producto_id;
            $detalle_cierre->save();

            $producto->stock = $producto->stock - $tmp_cierre->cantidad;
            $producto->precio_compra = $preciosCompra[$index];
            $producto->precio_venta = $preciosVenta[$index];
            $producto->save();



        }

        TmpCierre::where('session_id',$session_id)->delete();

        return redirect()->route('admin.cierres.index')
            ->with('mensaje', 'Cierre registrado exitosamente')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ide = Auth::user()->empresa_id;

        $empresa = Empresa::where('id',$ide)->first();
        $pais = DB::table('countries')->where('id',$empresa->pais)->first();
        $departamento = DB::table('states')->where('id',$empresa->departamento)->first();

        $cierre = Cierre::with('detallescierre')->findOrFail($id);
        $detalles = DetalleCierre::with('producto')->where('cierre_id',$id)->get();

        return view('admin.cierres.show', compact('cierre','detalles', 'empresa', 'pais', 'departamento'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cierre = Cierre::with('detallescierre')->findOrFail($id);
        $productos = Producto::all();
        //return response()->json($cierre);
        return view('admin.cierres.edit', compact('productos',  'cierre'));

    }

    public function pdf($id)
    {
        $cierre = Cierre::with('detallescierre')->findOrFail($id);
        $detalles = DetalleCierre::with('producto')->where('cierre_id',$id)->get();
        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id',$id_empresa)->first();
        $pdf = PDF::loadView('admin.cierres.pdf', compact('empresa', 'cierre', 'detalles'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function actualizarDetalle(Request $request, $id)
    {
        $detalle = DetalleCierre::findOrFail($id);
        $detalle->precio_compra = $request->precio_compra;
        $detalle->precio_venta = $request->precio_venta;
        $detalle->precio_total = $request->precio_total;
        $detalle->ganancia = $request->ganancia;
        $detalle->save();

        $producto = Producto::where('id', $detalle->producto_id)->first();
        $producto->precio_venta = $detalle->precio_venta;
        $detalle->precio_compra = $request->precio_compra;
        $producto->save();

        return response()->json(['message' => 'Precio actualizado correctamente']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$dato = Request()->all();
        //return response()->json($dato);

        $request->validate([
            'fecha' => 'required',
            'total' => 'required',
            'ganancia' => 'required',
        ]);

        //$detalle_compra = $request->precio_compra;
        //return response()->json($detalle_compra);

        $preciosCompra = $request->precio_compra;
        $preciosVenta = $request->precio_venta;


        $cierre = Cierre::where('id', $id)->first();
        $cierre->fecha = $request->fecha;
        $cierre->ganancia = $request->ganancia;
        $cierre->precio_total = $request->total;
        $cierre->empresa_id = Auth::user()->empresa_id;
        $cierre->save();

        return redirect()->route('admin.cierres.index')
            ->with('mensaje', 'Se Modifico el cierre exitosamente')
            ->with('icono', 'success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cierre = Cierre::find($id);

        foreach ($cierre->detallescierre as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $cierre->detallescierre()->delete();
        Cierre::destroy($id);
        return redirect()->route('admin.cierres.index');
    }
}
