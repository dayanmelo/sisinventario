<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cierre;
use App\Models\Compra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(){

        $total_roles = Role::count();
        $total_usuarios = User::where('empresa_id',Auth::user()->empresa_id)->count();
        $total_categorias = Categoria::where('empresa_id',Auth::user()->empresa_id)->count();
        $total_productos = Producto::where('empresa_id',Auth::user()->empresa_id)->count();
        $compras = Compra::where('empresa_id',Auth::user()->empresa_id)->sum('precio_compra');
        $cierres = Cierre::where('empresa_id',Auth::user()->empresa_id)->sum('precio_total');
        $ganancias = Cierre::where('empresa_id',Auth::user()->empresa_id)->sum('ganancia');


        $empresa_id =Auth::check() ? Auth::User()->empresa_id : redirect()->route('login')->send();
        $empresa = Empresa::where('id', $empresa_id)->first();

        return view('admin.index',compact(
            'empresa',
            'total_roles',
            'total_usuarios',
            'total_categorias',
        'total_productos',
        'compras',
        'cierres',
        'ganancias'));
    }
}
