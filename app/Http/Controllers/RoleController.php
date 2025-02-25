<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function asignar($id)
    {
        $rol = Role::find($id);
        $permisos = Permission::all()->groupBy(function ($permiso){
            if (stripos($permiso->name,'Us') !== false){
                return 'Usuarios';
            }elseif (stripos($permiso->name,'Rol') !== false){
                return 'Roles';
            }elseif (stripos($permiso->name,'Con') !== false){
                return 'Configuración';
            }elseif (stripos($permiso->name,'Per') !== false){
                return 'Permisos';
            }elseif (stripos($permiso->name,'Cie') !== false){
                return 'Cierres';
            }elseif (stripos($permiso->name,'Cat') !== false){
                return 'Categorias';
            }elseif (stripos($permiso->name,'Prod') !== false){
                return 'Productos';
            }elseif (stripos($permiso->name,'Prov') !== false){
                return 'Proveedores';
            }elseif (stripos($permiso->name,'Ven') !== false){
                return 'Ventas';
            }elseif (stripos($permiso->name,'Com') !== false){
                return 'Compras';
            }elseif (stripos($permiso->name,'Cli') !== false){
                return 'Clientes';
            }elseif (stripos($permiso->name,'Bac') !== false){
                return 'Copia De Seguridad';
            }
        });
        return view('admin.roles.asignar', compact('permisos','rol'));
    }

    public function update_asignar(Request $request, $id)
    {
        //$dato = request()->all();
        //return response()->json($dato);
        $request->validate([
            'permisos' => 'required|array',
        ]);
        $rol = Role::find($id);

        $rol->permissions()->sync($request->input('permisos'));
        return redirect()->back()
            ->with('mensaje', 'Permisos asignados exitosamente')
            ->with('icono', 'success');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $rol = new Role();

        $rol->name = $request->name;
        $rol->guard_name = "web";


        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje','Se Registro el rol Correctamente')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
        ]);

        $rol = Role::find($id);

        $rol->name = $request->name;
        $rol->guard_name = "web";


        $rol->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje','Se Modifico el rol Correctamente')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('admin.roles.index');
    }
}
