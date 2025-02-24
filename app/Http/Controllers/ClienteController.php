<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::where('empresa_id',Auth::user()->empresa_id)->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se Registrado el cliente exitosamente')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $cliente = Cliente::find($id);
        $cliente->nombre_cliente = $request->nombre;
        $cliente->cedula = $request->cedula;
        $cliente->telefono = $request->celular;
        $cliente->direccion = $request->direccion;
        $cliente->correo = $request->correo;
        $cliente->empresa_id = Auth::user()->empresa_id;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se Modifico el cliente exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index');
    }
}
