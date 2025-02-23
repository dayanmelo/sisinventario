<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\TmpVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detallesventa','cliente')->orderByRaw("estado = 1, created_at DESC")->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function cliente_store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre;
        $cliente->cedula = $request->cedula;
        $cliente->telefono = $request->celular;
        $cliente->direccion = $request->direccion;
        $cliente->correo = $request->correo;
        $cliente->empresa_id = Auth::user()->empresa_id;
        $cliente->save();

        return response()->json(['success'=>'datos guardados']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id',Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id',Auth::user()->empresa_id)->get();
        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id',$session_id)->get();
        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));

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
        $preciosVenta = $request->precio_venta;

        $venta = new Venta();
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->total;
        $venta->estado = '0';
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        $tmp_ventas = TmpVenta::where('session_id',$session_id)->get();
        foreach ($tmp_ventas as $index => $tmp_venta) {

            $producto = Producto::where('id', $tmp_venta->producto_id)->first();

            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;
            if (isset($preciosVenta[$index])) {
                $detalle_venta->precio_unitario = $preciosVenta[$index]; // Asigna el precio individual
            }
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;
            $detalle_venta->save();

            $producto->precio_venta = $preciosVenta[$index];
            $producto->save();



        }

        TmpVenta::where('session_id',$session_id)->delete();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta registrada exitosamente')
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

        $venta = Venta::with('detallesventa','cliente')->findOrFail($id);
        $detalles = DetalleVenta::with('producto')->where('venta_id',$id)->get();

        return view('admin.ventas.show', compact('venta','detalles', 'empresa', 'pais', 'departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $venta = Venta::with('detallesventa','cliente')->findOrFail($id);
        $productos = Producto::all();
        $clientes = Cliente::all();
        return view('admin.ventas.edit', compact('productos', 'clientes', 'venta'));
    }

    public function actualizarDetalle(Request $request, $id)
    {
        $detalle = DetalleVenta::findOrFail($id);
        $detalle->precio_unitario = $request->precio_unitario;
        $detalle->save();

        $producto = Producto::where('id', $detalle->producto_id)->first();
        $producto->precio_venta = $detalle->precio_unitario;
        $producto->save();

        return response()->json(['message' => 'Precio actualizado correctamente']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required',
            'total' => 'required',
        ]);

        //$detalle_compra = $request->precio_compra;
        //return response()->json($detalle_compra);

        $preciosVenta = $request->precio_venta;

        $venta = Venta::where('id', $id)->first();
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se Modifico la venta exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        foreach ($venta->detallesventa as $detalle) {
            $producto = Producto::find($detalle->producto_id);

            $producto->save();
        }

        Venta::where('id', $venta->id)->update(['estado' => '1']);
        return redirect()->route('admin.ventas.index');
    }
}
