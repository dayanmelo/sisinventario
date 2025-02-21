<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\detalleCompra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tmpcompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles')->get();
        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id',Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id',Auth::user()->empresa_id)->get();
        $session_id = session()->getId();
        $tmp_compras = TmpCompra::where('session_id',$session_id)->get();
        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
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
        ]);

        //$detalle_compra = $request->precio_compra;
        //return response()->json($detalle_compra);

        $session_id = session()->getId();
        $preciosCompra = $request->precio_compra;

        $compra = new Compra();
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_compra = $request->total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        $tmp_compras = Tmpcompra::where('session_id',$session_id)->get();
        foreach ($tmp_compras as $index => $tmp_compra) {

            $producto = Producto::where('id', $tmp_compra->producto_id)->first();

            $detalle_compra = new detalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;
            if (isset($preciosCompra[$index])) {
                $detalle_compra->precio_unitario = $preciosCompra[$index]; // Asigna el precio individual
            }
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;
            $detalle_compra->proveedor_id = $request->proveedor_id;
            $detalle_compra->save();

            $producto->stock = $producto->stock + $tmp_compra->cantidad;
            $producto->precio_compra = $preciosCompra[$index];
            $producto->save();



        }

        Tmpcompra::where('session_id',$session_id)->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada exitosamente')
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

        $compra = Compra::with('detalles')->findOrFail($id);
        $proveedor = detalleCompra::with('proveedor')->where('compra_id',$id)->first();
        $detalles = detalleCompra::with('producto')->where('compra_id',$id)->get();

        return view('admin.compras.show', compact('compra','detalles','proveedor', 'empresa', 'pais', 'departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles')->findOrFail($id);
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('admin.compras.edit', compact('productos', 'proveedores', 'compra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /*$dato = Request()->all();
        return response()->json($dato);*/
        $request->validate([
            'fecha' => 'required',
            'total' => 'required',
        ]);

        //$detalle_compra = $request->precio_compra;
        //return response()->json($detalle_compra);

        $session_id = session()->getId();
        $preciosCompra = $request->precio_compra;

        $compra = new Compra();
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_compra = $request->total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        $tmp_compras = Tmpcompra::where('session_id',$session_id)->get();
        foreach ($tmp_compras as $index => $tmp_compra) {

            $producto = Producto::where('id', $tmp_compra->producto_id)->first();

            $detalle_compra = new detalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;
            if (isset($preciosCompra[$index])) {
                $detalle_compra->precio_unitario = $preciosCompra[$index]; // Asigna el precio individual
            }
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;
            $detalle_compra->proveedor_id = $request->proveedor_id;
            $detalle_compra->save();

            $producto->stock = $producto->stock + $tmp_compra->cantidad;
            $producto->precio_compra = $preciosCompra[$index];
            $producto->save();



        }

        Tmpcompra::where('session_id',$session_id)->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
