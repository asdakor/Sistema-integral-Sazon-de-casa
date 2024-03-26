<?php

use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\BoletasController;
use App\Http\Controllers\DetallesController;
use App\Http\Controllers\DetallesBoletasController;
use App\Http\Controllers\MermasController;
use App\Http\Controllers\ProductosFinalesController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RecetasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoriasController;
use App\Models\Detalles;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RolesController;

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
Route::get('/alpine', function () {
    return view('alpinetest');
});
Route::get('/', function () {
    return redirect()->route('login');
});
Route::any('/registro', [RegisterController::class, 'registro'])->name('registro.formulario');
Route::any('/registro/guardar', [RegisterController::class, 'store'])->name('registro.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::any('/admindashboard', [AdministracionController::class, 'index'])->name('admindashboard');


    Route::any('/facturas/ingreso', [FacturasController::class, 'ingresar'])->name('facturas.ingresar');
    Route::any('/facturas/buscar', [FacturasController::class, 'buscar'])->name('facturas.buscar');
    Route::any('/facturas/buscarfecha', [FacturasController::class, 'buscarfecha'])->name('facturas.buscarfecha');
    Route::any('/facturas/listadoporfecha', [FacturasController::class, 'listadoporfecha'])->name('facturas.listadoporfecha');
    Route::any('/facturas/buscarfactura', [FacturasController::class, 'buscarfactura'])->name('facturas.buscarfactura');
    Route::any('/facturas/{factura}/', [FacturasController::class, 'existente'])->name('facturas.existente');
    Route::any('/facturas/{factura}/eliminar', [FacturasController::class, 'eliminar'])->name('facturas.eliminar');


    Route::any('/facturas/ingresaren/guardado', [FacturasController::class, 'guardar'])->name('facturas.guardar');

    Route::any('/facturas/ingresaren/guardaren', [FacturasController::class, 'guardaren'])->name('facturas.guardaren');
    Route::delete('detalles/{detalles}', [DetallesController::class, 'destroy'])->name('detalle.destroy');


    ///SISTEMA DE CAJA
    Route::any('/sazondecasa/caja', [CajaController::class, 'cajasazon'])->name('sazon.caja');
    Route::any('/test', [CajaController::class, 'test'])->name('test');
    Route::any('/listaproductos', [CajaController::class, 'actualizarlista'])->name('actualizar.lista');
    Route::any('/sazondecasa/caja/{boleta}', [CajaController::class, 'test2'])->name('test2');
    Route::any('/listaproductos2/{boleta}', [CajaController::class, 'actualizarlista2'])->name('actualizar2.lista');
    Route::any('/agregardetalle/{boleta}', [CajaController::class, 'agregardetalle'])->name('test3');
    Route::any('/generarboleta/{boleta}', [CajaController::class, 'generar'])->name('generar');
    Route::any('/cancelar/{boleta}', [BoletasController::class, 'cancelarcompra'])->name('boleta.cancelar');
    Route::any('detallesboleta/{detallesBoletas}', [DetallesBoletasController::class, 'destroy'])->name('detalleboleta.destroy');


    Route::any('/iniciocaja', [CajaController::class, 'iniciocaja'])->name('caja.inicio');
    Route::any('/iniciocaja/validar', [CajaController::class, 'validarcajero'])->name('validar.cajero');
    Route::any('/platos/listar', [CajaController::class, 'listar'])->name('platos.listar');
    Route::any('/generarboletapdf/{boleta}', [CajaController::class, 'boletapdf'])->name('boleta.pdf');

    //USUARIOS CRUD
    Route::any('/usuarios/crear', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::any('/usuarios/listado', [UsuariosController::class, 'listado'])->name('usuarios.listado');
    Route::any('/usuarios/{usuario}/show', [UsuariosController::class, 'show'])->name('usuarios.show');
    Route::any('/usuarios/{usuario}/destroy', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    Route::any('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::any('/usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::any('/usuarios/{usuario}/update', [UsuariosController::class, 'update'])->name('usuarios.update');
    //ROLES CRUD
    Route::any('/roles/crear', [RolesController::class, 'create'])->name('roles.create');
    Route::any('/roles/listado', [RolesController::class, 'listado'])->name('roles.listado');
    Route::any('/roles/{rol}/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
    Route::any('/roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::any('/roles/{rol}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::any('/roles/{rol}/update', [RolesController::class, 'update'])->name('roles.update');
    Route::any('/roles/{rol}/show', [RolesController::class, 'show'])->name('roles.show');

    //CATEGORIAS CRUD
    Route::any('/categorias/crear', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::any('/categorias/listado', [CategoriasController::class, 'listado'])->name('categorias.listado');
    Route::any('/categorias/{categoria}/destroy', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
    Route::any('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::any('/categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::any('/categorias/{categoria}/update', [CategoriasController::class, 'update'])->name('categorias.update');

    //PRODUCTOSFINALES CRUD
    Route::any('/productosfinales/crear', [ProductosFinalesController::class, 'create'])->name('productosfinales.create');
    Route::any('/productosfinales/listado', [ProductosFinalesController::class, 'listado'])->name('productosfinales.listado');
    Route::any('/productosfinales/{productofinal}/destroy', [ProductosFinalesController::class, 'destroy'])->name('productosfinales.destroy');
    Route::any('/productosfinales/store', [ProductosFinalesController::class, 'store'])->name('productosfinales.store');
    Route::any('/productosfinales/{productofinal}/edit', [ProductosFinalesController::class, 'edit'])->name('productosfinales.edit');
    Route::any('/productosfinales/{productofinal}/update', [ProductosFinalesController::class, 'update'])->name('productosfinales.update');
    Route::any('/productosfinales/{productofinal}/show', [ProductosFinalesController::class, 'show'])->name('productosfinales.show');

    //PROVEEDORES CRUD
    Route::any('/proveedores/crear', [ProveedoresController::class, 'create'])->name('proveedores.create');
    Route::any('/proveedores/listado', [ProveedoresController::class, 'listado'])->name('proveedores.listado');
    Route::any('/proveedores/{proveedor}/destroy', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');
    Route::any('/proveedores/store', [ProveedoresController::class, 'store'])->name('proveedores.store');
    Route::any('/proveedores/{proveedor}/edit', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
    Route::any('/proveedores/{proveedor}/update', [ProveedoresController::class, 'update'])->name('proveedores.update');
    Route::any('/proveedores/asignar', [ProveedoresController::class, 'asignar'])->name('asignar.producto');
    Route::any('/proveedores/quitar', [ProveedoresController::class, 'quitar'])->name('quitar.producto');
    //CATEGORIAS PRODUCTOS
    Route::any('/productos/crear', [ProductosController::class, 'create'])->name('productos.create');
    Route::any('/productos/listado', [ProductosController::class, 'listado'])->name('productos.listado');
    Route::any('/productos/{producto}/destroy', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::any('/productos/store', [ProductosController::class, 'store'])->name('productos.store');
    Route::any('/productos/{producto}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::any('/productos/{producto}/update', [ProductosController::class, 'update'])->name('productos.update');
    //ADMINISTRATIVO BOLETAS
    Route::any('/boletas/buscar', [BoletasController::class, 'buscar'])->name('boletas.buscar');
    Route::any('/boletas/filtrar', [BoletasController::class, 'filtrar'])->name('boletas.filtrar');

    Route::any('/boletas/deldia', [BoletasController::class, 'deldia'])->name('boletas.deldia');
    Route::any('/boletas/porfecha', [BoletasController::class, 'porfecha'])->name('boletas.porfecha');
    Route::any('/boletas/listadoporfecha', [BoletasController::class, 'listadoporfecha'])->name('boletas.listadoporfecha');
    Route::any('/boletas/anular', [BoletasController::class, 'anularboleta'])->name('boletas.anularboleta');
    Route::any('/boletas/anularboleta', [BoletasController::class, 'filtraranular'])->name('boletas.filtraranular');
    Route::any('/boletas/anular/{boleta}/encontrada', [BoletasController::class, 'anularencontrada'])->name('boletas.anularencontrada');
    Route::any('/boletas/anular/{boleta}/destroy', [BoletasController::class, 'destroy'])->name('boletas.destroy');
    Route::any('/boletas/{boleta}', [BoletasController::class, 'encontrada'])->name('boletas.encontrada');

    //RECETAS CRUD
    Route::any('/recetas/crear', [RecetasController::class, 'create'])->name('recetas.create');
    Route::any('/recetas/ingresar', [RecetasController::class, 'ingresar'])->name('recetas.ingresar');
    Route::any('/recetas/crearreceta', [RecetasController::class, 'crearreceta'])->name('recetas.crearreceta');
    Route::any('/recetas/crearreceta/agregar', [RecetasController::class, 'agregar'])->name('recetas.agregar');
    Route::any('/recetas/editar/{productofinal}', [RecetasController::class, 'editarreceta'])->name('recetas.editarreceta');
    Route::any('/recetas/eliminar/{receta}', [RecetasController::class, 'destroy'])->name('recetas.destroy');

    //AJUSTES
    Route::any('/mermas/crear', [MermasController::class, 'create'])->name('mermas.create');
    Route::any('/mermas/store', [MermasController::class, 'store'])->name('mermas.store');
    Route::any('/ajustes/stock', [MermasController::class, 'ajustar'])->name('ajustes.stock');
    Route::any('/ajustes/stock/{producto}', [MermasController::class, 'guardarajuste'])->name('ajustes.guardar');
    Route::any('/ingresar/control', [AdministracionController::class, 'fecha'])->name('fecha.control');
    Route::any('/ingresar/controlexistencias', [AdministracionController::class, 'ingresarcontrol'])->name('administracion.control');
    Route::any('/ingresar/controlexistencias/{producto}', [AdministracionController::class, 'guardar'])->name('control.guardar');
    Route::any('/revisar/control/', [AdministracionController::class, 'revisarfecha'])->name('fecha.revisar');
    Route::any('/revisar/controlexistencias/', [AdministracionController::class, 'listadoporfecha'])->name('listado.revisar');
});