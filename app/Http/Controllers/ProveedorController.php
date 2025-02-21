<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa = Empresa::where('id',Auth::user()->empresa_id)->first();
        $proveedores = Proveedor::all();
        return view('admin.proveedores.index', compact('proveedores','empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'empresa' => 'required',
            'correo' => 'required',
            'celular' => 'required',
        ]);

        $proveedor = new Proveedor();

        $proveedor->empresa = $request->empresa;
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;


        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se Registro el proveedor correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor=Proveedor::find($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'empresa' => 'required',
            'correo' => 'required',
            'celular' => 'required',
        ]);

        $proveedor = Proveedor::find($id);

        $proveedor->empresa = $request->empresa;
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->correo = $request->correo;
        $proveedor->telefono = $request->telefono;
        $proveedor->celular = $request->celular;
        $proveedor->empresa_id = Auth::user()->empresa_id;


        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Se Modifico el proveedor correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return redirect()->route('admin.proveedores.index');
    }
}
