<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index.home')->middleware('auth');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/crear-empresa',[App\Http\Controllers\EmpresaController::class,'create'])->name('admin.empresas.create');
Route::get('/crear-empresa/departamento/{id_pais}',[App\Http\Controllers\EmpresaController::class,'buscarpais'])->name('admin.empresas.create.buscarpais');
Route::get('/crear-empresa/ciudades/{id_departamento}',[App\Http\Controllers\EmpresaController::class,'buscardepartamento'])->name('admin.empresas.create.buscardepartamento');
Route::post('/crear-empresa/create',[App\Http\Controllers\EmpresaController::class,'store'])->name('admin.empresas.create.store');

//Rutas para configuraciones
Route::get('/admin/configuracion', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.configuraciones.edit')->middleware('auth');
Route::put('/admin/configuracion/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.configuraciones.update')->middleware('auth','can:Configuracion');


//Rutas para roles
Route::get('/admin/roles',[App\Http\Controllers\RoleController::class,'index'])->name('admin.roles.index')->middleware('auth','can:Roles');
Route::get('/admin/roles/create',[App\Http\Controllers\RoleController::class,'create'])->name('admin.roles.create')->middleware('auth','can:Crear Rol');
Route::post('/admin/roles/create',[App\Http\Controllers\RoleController::class,'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}',[App\Http\Controllers\RoleController::class,'show'])->name('admin.roles.show')->middleware('auth' ,'can:Ver Rol');
Route::get('/admin/roles/{id}/edit',[App\Http\Controllers\RoleController::class,'edit'])->name('admin.roles.edit')->middleware('auth','can:Modificar Rol');
Route::get('/admin/roles/{id}/asignar',[App\Http\Controllers\RoleController::class,'asignar'])->name('admin.roles.asignar')->middleware('auth');
Route::put('/admin/roles/{id}',[App\Http\Controllers\RoleController::class,'update'])->name('admin.roles.update')->middleware('auth','can:Asignar Permiso');
Route::put('/admin/roles/asignar/{id}',[App\Http\Controllers\RoleController::class,'update_asignar'])->name('admin.roles.update_asignar')->middleware('auth');
Route::delete('/admin/roles/{id}',[App\Http\Controllers\RoleController::class,'destroy'])->name('admin.roles.destroy')->middleware('auth','can:Eliminar Rol');


//Rutas para permisos
Route::get('/admin/permisos',[App\Http\Controllers\PermisoController::class,'index'])->name('admin.permisos.index')->middleware('auth','can:Permisos');
Route::get('/admin/permisos/create',[App\Http\Controllers\PermisoController::class,'create'])->name('admin.permisos.create')->middleware('auth','can:Crear Permiso');
Route::post('/admin/permisos/create',[App\Http\Controllers\PermisoController::class,'store'])->name('admin.permisos.store')->middleware('auth');
Route::get('/admin/permisos/{id}',[App\Http\Controllers\PermisoController::class,'show'])->name('admin.permisos.show')->middleware('auth','can:Ver Permiso');
Route::get('/admin/permisos/{id}/edit',[App\Http\Controllers\PermisoController::class,'edit'])->name('admin.permisos.edit')->middleware('auth','can:Modificar Permiso');
Route::put('/admin/permisos/{id}',[App\Http\Controllers\PermisoController::class,'update'])->name('admin.permisos.update')->middleware('auth');
Route::delete('/admin/permisos/{id}',[App\Http\Controllers\PermisoController::class,'destroy'])->name('admin.permisos.destroy')->middleware('auth','can:Eliminar Permiso');



//Rutas para usuarios
Route::get('/admin/usuarios',[App\Http\Controllers\UsuarioController::class,'index'])->name('admin.usuarios.index')->middleware('auth','can:Usuarios');
Route::get('/admin/usuarios/create',[App\Http\Controllers\UsuarioController::class,'create'])->name('admin.usuarios.create')->middleware('auth','can:Crear Usuario');
Route::post('/admin/usuarios/create',[App\Http\Controllers\UsuarioController::class,'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}',[App\Http\Controllers\UsuarioController::class,'show'])->name('admin.usuarios.show')->middleware('auth','can:Ver Usuario');
Route::get('/admin/usuarios/{id}/edit',[App\Http\Controllers\UsuarioController::class,'edit'])->name('admin.usuarios.edit')->middleware('auth','can:Modificar Usuario');
Route::put('/admin/usuarios/{id}',[App\Http\Controllers\UsuarioController::class,'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}',[App\Http\Controllers\UsuarioController::class,'destroy'])->name('admin.usuarios.destroy')->middleware('auth','can:Eliminar Usuario');
Route::post('/admin/usuarios/verificar/{id}',[App\Http\Controllers\UsuarioController::class,'verificar'])->name('admin.usuarios.verificar')->middleware('auth');


//Rutas para categorias
Route::get('/admin/categorias',[App\Http\Controllers\CategoriaController::class,'index'])->name('admin.categorias.index')->middleware('auth','can:Categorias');
Route::get('/admin/categorias/create',[App\Http\Controllers\CategoriaController::class,'create'])->name('admin.categorias.create')->middleware('auth','can:Crear Categoria');
Route::post('/admin/categorias/create',[App\Http\Controllers\CategoriaController::class,'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categorias/{id}',[App\Http\Controllers\CategoriaController::class,'show'])->name('admin.categorias.show')->middleware('auth','can:Ver Categoria');
Route::get('/admin/categorias/{id}/edit',[App\Http\Controllers\CategoriaController::class,'edit'])->name('admin.categorias.edit')->middleware('auth','can:Modificar Categoria');
Route::put('/admin/categorias/{id}',[App\Http\Controllers\CategoriaController::class,'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/{id}',[App\Http\Controllers\CategoriaController::class,'destroy'])->name('admin.categorias.destroy')->middleware('auth','can:Eliminar Categoria');


//Rutas para productos
Route::get('/admin/productos',[App\Http\Controllers\ProductoController::class,'index'])->name('admin.productos.index')->middleware('auth','can:Productos');
Route::get('/admin/productos/create',[App\Http\Controllers\ProductoController::class,'create'])->name('admin.productos.create')->middleware('auth','can:Crear Producto');
Route::post('/admin/productos/create',[App\Http\Controllers\ProductoController::class,'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/productos/{id}',[App\Http\Controllers\ProductoController::class,'show'])->name('admin.productos.show')->middleware('auth','can:Ver Producto');
Route::get('/admin/productos/{id}/edit',[App\Http\Controllers\ProductoController::class,'edit'])->name('admin.productos.edit')->middleware('auth','can:Modificar Producto');
Route::put('/admin/productos/{id}',[App\Http\Controllers\ProductoController::class,'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/{id}',[App\Http\Controllers\ProductoController::class,'destroy'])->name('admin.productos.destroy')->middleware('auth','can:Eliminar Producto');

//Rutas para proveedores
Route::get('/admin/proveedores',[App\Http\Controllers\ProveedorController::class,'index'])->name('admin.proveedores.index')->middleware('auth','can:Proveedores');
Route::get('/admin/proveedores/create',[App\Http\Controllers\ProveedorController::class,'create'])->name('admin.proveedores.create')->middleware('auth','can:Crear Proveedor');
Route::post('/admin/proveedores/create',[App\Http\Controllers\ProveedorController::class,'store'])->name('admin.proveedores.store')->middleware('auth');
Route::get('/admin/proveedores/{id}',[App\Http\Controllers\ProveedorController::class,'show'])->name('admin.proveedores.show')->middleware('auth','can:Ver Proveedor');
Route::get('/admin/proveedores/{id}/edit',[App\Http\Controllers\ProveedorController::class,'edit'])->name('admin.proveedores.edit')->middleware('auth','can:Modificar Proveedor');
Route::put('/admin/proveedores/{id}',[App\Http\Controllers\ProveedorController::class,'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/admin/proveedores/{id}',[App\Http\Controllers\ProveedorController::class,'destroy'])->name('admin.proveedores.destroy')->middleware('auth','can:Eliminar Proveedor');


//Rutas para compras
Route::get('/admin/compras',[App\Http\Controllers\CompraController::class,'index'])->name('admin.compras.index')->middleware('auth','can:Compras');
Route::get('/admin/compras/create',[App\Http\Controllers\CompraController::class,'create'])->name('admin.compras.create')->middleware('auth','can:Crear Compra');
Route::post('/admin/compras/create',[App\Http\Controllers\CompraController::class,'store'])->name('admin.compras.store')->middleware('auth');
Route::get('/admin/compras/{id}',[App\Http\Controllers\CompraController::class,'show'])->name('admin.compras.show')->middleware('auth','can:Ver Compra');
Route::get('/admin/compras/{id}/edit',[App\Http\Controllers\CompraController::class,'edit'])->name('admin.compras.edit')->middleware('auth','can:Modificar Compra');
Route::put('/admin/compras/{id}',[App\Http\Controllers\CompraController::class,'update'])->name('admin.compras.update')->middleware('auth');
Route::delete('/admin/compras/{id}',[App\Http\Controllers\CompraController::class,'destroy'])->name('admin.compras.destroy')->middleware('auth','can:Eliminar Compra');


//Rutas para tmp_compras
Route::post('/admin/compras/create/tmp',[App\Http\Controllers\TmpcompraController::class,'tmp_compras'])->name('admin.compras.tmp_compras')->middleware('auth');
Route::delete('/admin/compras/create/tmp/{id}',[App\Http\Controllers\TmpcompraController::class,'destroy'])->name('admin.compras.tmp_compras.destroy')->middleware('auth');


//Rutas para detalles de las compras
Route::delete('/admin/compras/detalle/{id}',[App\Http\Controllers\DetalleCompraController::class,'destroy'])->name('admin.detalle.compras.destroy')->middleware('auth');
Route::post('/admin/compras/detalle/create/',[App\Http\Controllers\DetalleCompraController::class,'store'])->name('admin.detalle.compras.store')->middleware('auth');
Route::put('/admin/compras/detalles/{id}',[App\Http\Controllers\CompraController::class,'actualizarDetalle'])->name('admin.compras.actualizarDetalle')->middleware('auth');


//Rutas para clientes
Route::get('/admin/clientes',[App\Http\Controllers\ClienteController::class,'index'])->name('admin.clientes.index')->middleware('auth','can:Clientes');
Route::get('/admin/clientes/create',[App\Http\Controllers\ClienteController::class,'create'])->name('admin.clientes.create')->middleware('auth','can:Crear Cliente');
Route::post('/admin/clientes/create',[App\Http\Controllers\ClienteController::class,'store'])->name('admin.clientes.store')->middleware('auth');
Route::get('/admin/clientes/{id}',[App\Http\Controllers\ClienteController::class,'show'])->name('admin.clientes.show')->middleware('auth','can:Ver Cliente');
Route::get('/admin/clientes/{id}/edit',[App\Http\Controllers\ClienteController::class,'edit'])->name('admin.clientes.edit')->middleware('auth','can:Modificar Cliente');
Route::put('/admin/clientes/{id}',[App\Http\Controllers\ClienteController::class,'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/admin/clientes/{id}',[App\Http\Controllers\ClienteController::class,'destroy'])->name('admin.clientes.destroy')->middleware('auth','can:Eliminar Cliente');


//Rutas para ventas
Route::get('/admin/ventas',[App\Http\Controllers\VentaController::class,'index'])->name('admin.ventas.index')->middleware('auth','can:Ventas');
Route::get('/admin/ventas/create',[App\Http\Controllers\VentaController::class,'create'])->name('admin.ventas.create')->middleware('auth','can:Crear Venta');
Route::post('/admin/ventas/create',[App\Http\Controllers\VentaController::class,'store'])->name('admin.ventas.store')->middleware('auth');
Route::get('/admin/ventas/{id}',[App\Http\Controllers\VentaController::class,'show'])->name('admin.ventas.show')->middleware('auth','can:Ver Venta');
Route::get('/admin/ventas/{id}/edit',[App\Http\Controllers\VentaController::class,'edit'])->name('admin.ventas.edit')->middleware('auth','can:Modificar Venta');
Route::put('/admin/ventas/{id}',[App\Http\Controllers\VentaController::class,'update'])->name('admin.ventas.update')->middleware('auth');
Route::delete('/admin/ventas/{id}',[App\Http\Controllers\VentaController::class,'destroy'])->name('admin.ventas.destroy')->middleware('auth','can:Eliminar Venta');
Route::post('/admin/ventas/cliente/create',[App\Http\Controllers\VentaController::class,'cliente_store'])->name('admin.ventas.cliente.store')->middleware('auth');


//Rutas para tmp_ventas
Route::post('/admin/ventas/create/tmp',[App\Http\Controllers\TmpVentaController::class,'tmp_ventas'])->name('admin.ventas.tmp_ventas')->middleware('auth');
Route::delete('/admin/ventas/create/tmp/{id}',[App\Http\Controllers\TmpVentaController::class,'destroy'])->name('admin.ventas.tmp_ventas.destroy')->middleware('auth');


//Rutas para detalles de las ventas
Route::delete('/admin/ventas/detalle/{id}',[App\Http\Controllers\DetalleVentaController::class,'destroy'])->name('admin.detalle.ventas.destroy')->middleware('auth');
Route::post('/admin/ventas/detalle/create/',[App\Http\Controllers\DetalleVentaController::class,'store'])->name('admin.detalle.ventas.store')->middleware('auth');
Route::put('/admin/ventas/detalles/{id}',[App\Http\Controllers\VentaController::class,'actualizarDetalle'])->name('admin.ventas.actualizarDetalle')->middleware('auth');


//Rutas para cierres
Route::get('/admin/cierres',[App\Http\Controllers\CierreController::class,'index'])->name('admin.cierres.index')->middleware('auth','can:Cierres');
Route::get('/admin/cierres/create',[App\Http\Controllers\CierreController::class,'create'])->name('admin.cierres.create')->middleware('auth','can:Crear Cierre');
Route::post('/admin/cierres/create',[App\Http\Controllers\CierreController::class,'store'])->name('admin.cierres.store')->middleware('auth');
Route::get('/admin/cierres/{id}',[App\Http\Controllers\CierreController::class,'show'])->name('admin.cierres.show')->middleware('auth','can:Ver Cierre');
Route::get('/admin/cierres/{id}/edit',[App\Http\Controllers\CierreController::class,'edit'])->name('admin.cierres.edit')->middleware('auth','can:Modificar Cierre');
Route::get('/admin/cierres/pdf/{id}',[App\Http\Controllers\CierreController::class,'pdf'])->name('admin.cierres.pdf')->middleware('auth','can:Reporte Cierre');
Route::put('/admin/cierres/{id}',[App\Http\Controllers\CierreController::class,'update'])->name('admin.cierres.update')->middleware('auth');
Route::delete('/admin/cierres/{id}',[App\Http\Controllers\CierreController::class,'destroy'])->name('admin.cierres.destroy')->middleware('auth','can:Eliminar Cierre');


//Rutas para tmp_cierres
Route::post('/admin/cierres/create/tmp',[App\Http\Controllers\TmpCierreController::class,'tmp_cierres'])->name('admin.cierres.tmp_cierres')->middleware('auth');
Route::delete('/admin/cierres/create/tmp/{id}',[App\Http\Controllers\TmpCierreController::class,'destroy'])->name('admin.cierres.tmp_cierres.destroy')->middleware('auth');


//Rutas para detalles de los cierres
Route::delete('/admin/cierres/detalle/{id}',[App\Http\Controllers\DetalleCierreController::class,'destroy'])->name('admin.detalle.cierres.destroy')->middleware('auth');
Route::post('/admin/cierres/detalle/create/',[App\Http\Controllers\DetalleCierreController::class,'store'])->name('admin.detalle.cierres.store')->middleware('auth');
Route::put('/admin/cierres/detalles/{id}',[App\Http\Controllers\CierreController::class,'actualizarDetalle'])->name('admin.cierres.actualizarDetalle')->middleware('auth');


//Rutas de reportes
Route::get('/admin/reportes/re_producto',[App\Http\Controllers\ReporteController::class,'repproducto'])->name('admin.reportes.re_producto')->middleware('auth','can:Reporte Producto');
Route::get('/admin/reportes/reventa/{id}',[App\Http\Controllers\ReporteController::class,'repventa'])->name('admin.reportes.reventa')->middleware('auth','can:Reporte Venta');
