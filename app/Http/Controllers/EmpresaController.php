<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
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
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        return view('admin.empresas.create', compact('paises','estados', 'ciudades','monedas'));
    }

    public function buscarpais($id_pais)
    {
        try {
            $estados = DB::table('states')->where('country_id',$id_pais)->get();
            return view('admin.empresas.cargar_estados', compact('estados'));
        }catch (\Exception $e){
            return response()->json(['mensaje'=>'Error']);
        }
    }

    public function buscardepartamento($id_departamento)
    {
        try {
            $ciudades = DB::table('cities')->where('state_id',$id_departamento)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        }catch (\Exception $e){
            return response()->json(['mensaje'=>'Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);

        $request->validate([
            'pais' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'telefono' => 'required',
            'codigo_postal' => 'required',
            'direccion' => 'required',
            'correo' => 'required|unique:empresas',
            'moneda' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $empresa = new Empresa();

        $empresa->pais = $request->pais;
        $empresa->departamento = $request->departamento;
        $empresa->ciudad = $request->ciudad;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->telefono = $request->telefono;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->direccion = $request->direccion;
        $empresa->correo = $request->correo;
        $empresa->moneda = $request->moneda;
        $empresa->logo = $request->file('logo')->store('logos','public');

        $empresa->save();

        $usuario = new User();

        $usuario->name = "Administrador";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['telefono']);
        $usuario->empresa_id = $empresa->id;

        $usuario->save();
        $usuario->assignRole('SUPER_ADMIN');

        Auth::login($usuario);

        return redirect()->route('admin.index')
        ->with('mensaje','Se Registro la Empresa Correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        //$ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        $empresa_id = Auth::User()->empresa_id;
        $empresa = Empresa::where('id', $empresa_id)->first();
        $departamentos = DB::table('states')->where('country_id', $empresa->pais)->get();
        $ciudades = DB::table('cities')->where('state_id', $empresa->departamento)->get();

        return view('admin.configuraciones.edit',compact('paises', 'estados', 'ciudades','monedas','empresa', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = $request->all();
        //return response()->json($datos);
        $request->validate([
            'pais' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'telefono' => 'required',
            'codigo_postal' => 'required',
            'direccion' => 'required',
            'correo' => 'required|unique:empresas,correo,'.$id,
            'moneda' => 'required',
        ]);

        $empresa = Empresa::find($id);

        $empresa->pais = $request->pais;
        $empresa->departamento = $request->departamento;
        $empresa->ciudad = $request->ciudad;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->telefono = $request->telefono;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->direccion = $request->direccion;
        $empresa->correo = $request->correo;
        $empresa->moneda = $request->moneda;

        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $empresa->logo);
            $empresa->logo = $request->file('logo')->store('logos','public');
        }


        $empresa->save();

        $usuario_id = Auth::user()->id;
        $usuario = User::find($usuario_id);

        $usuario->name = "Administrador";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['telefono']);
        $usuario->empresa_id = $empresa->id;

        $usuario->save();

        return redirect()->route('admin.index')
            ->with('mensaje','Se Modifico la Empresa Correctamente')
            ->with('icono','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
