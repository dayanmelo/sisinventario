<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function index(){
        $permisos = Permission::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    public function create(){
        return view('admin.permisos.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name'=>$request->name]);

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Permiso creado con exito')
            ->with('icono', 'success');
    }

    public function show($id){
        $permiso = Permission::find($id);
        return view('admin.permisos.show', compact('permiso'));
    }

    public function edit($id){
        $permiso = Permission::find($id);
        return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
        ]);

        $permiso = Permission::find($id);
        $permiso->update(['name' => $request->name]);

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'Permiso modificado con exito')
            ->with('icono', 'success');
    }

    public function destroy($id){
        $permiso = Permission::find($id);
        $permiso->delete();
        return redirect()->route('admin.permisos.index');
    }
}
