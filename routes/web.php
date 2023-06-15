<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



//Auth::routes();

Auth::routes(['register' => false]);


//reportes
Route::get('users/reportes', [App\Http\Controllers\UserController::class, 'reportes'])->name('users.reportes')->middleware('auth');

Route::post('users/reporte_pdf', [App\Http\Controllers\UserController::class, 'reporte_pdf'])->name('users.reporte_pdf')->middleware('auth');

Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');

Route::get('home/pdf', [App\Http\Controllers\HomeController::class, 'pdf'])->name('home.pdf');
//Route::get('home/pdf', [App\Http\Controllers\HomeController::class, 'pdf'])->name('home.pdf')->middleware('auth');
//Route::get('/rutas/{id}', [App\Http\Controllers\HomeController::class, 'rutas'])->name('rutas')->middleware('auth');
Route::get('/rutas/{id}', [App\Http\Controllers\HomeController::class, 'rutas'])->name('rutas');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');





//reportes
Route::get('tipobos/reportes', [App\Http\Controllers\TipoboController::class, 'reportes'])->name('tipobos.reportes')->middleware('auth');

Route::post('tipobos/reporte_pdf', [App\Http\Controllers\TipoboController::class, 'reporte_pdf'])->name('tipobos.reporte_pdf')->middleware('auth');

Route::resource('tipobos', App\Http\Controllers\TipoboController::class)->middleware('auth');


//reportes
Route::get('bos/reportes', [App\Http\Controllers\BoController::class, 'reportes'])->name('bos.reportes')->middleware('auth');

Route::post('bos/reporte_pdf', [App\Http\Controllers\BoController::class, 'reporte_pdf'])->name('bos.reporte_pdf')->middleware('auth');


Route::resource('bos', App\Http\Controllers\BoController::class)->middleware('auth');

Route::resource('tipossgps', App\Http\Controllers\TipossgpController::class)->middleware('auth');

//reportes
Route::get('estados/reportes', [App\Http\Controllers\EstadoController::class, 'reportes'])->name('estados.reportes')->middleware('auth');

Route::post('estados/reporte_pdf', [App\Http\Controllers\EstadoController::class, 'reporte_pdf'])->name('estados.reporte_pdf')->middleware('auth');

Route::resource('estados', App\Http\Controllers\EstadoController::class)->middleware('auth');


//reportes
Route::get('instituciones/reportes', [App\Http\Controllers\InstitucioneController::class, 'reportes'])->name('instituciones.reportes')->middleware('auth');

Route::post('instituciones/reporte_pdf', [App\Http\Controllers\InstitucioneController::class, 'reporte_pdf'])->name('instituciones.reporte_pdf')->middleware('auth');

Route::resource('instituciones', App\Http\Controllers\InstitucioneController::class)->middleware('auth');

Route::resource('financiamientos', App\Http\Controllers\FinanciamientoController::class)->middleware('auth');


//reportes
Route::get('municipios/reportes', [App\Http\Controllers\MunicipioController::class, 'reportes'])->name('municipios.reportes')->middleware('auth');

Route::post('municipios/reporte_pdf', [App\Http\Controllers\MunicipioController::class, 'reporte_pdf'])->name('municipios.reporte_pdf')->middleware('auth');

Route::resource('municipios', App\Http\Controllers\MunicipioController::class)->middleware('auth');

Route::resource('ejecuciondetalles', App\Http\Controllers\EjecuciondetalleController::class)->middleware('auth');


//reportes
Route::get('objetivoshistoricos/reportes', [App\Http\Controllers\ObjetivoshistoricoController::class, 'reportes'])->name('objetivoshistoricos.reportes')->middleware('auth');

Route::post('objetivoshistoricos/reporte_pdf', [App\Http\Controllers\ObjetivoshistoricoController::class, 'reporte_pdf'])->name('objetivoshistoricos.reporte_pdf')->middleware('auth');

Route::resource('objetivoshistoricos', App\Http\Controllers\ObjetivoshistoricoController::class)->middleware('auth');


//reportes
Route::get('objetivosestrategicos/reportes', [App\Http\Controllers\ObjetivosestrategicoController::class, 'reportes'])->name('objetivosestrategicos.reportes')->middleware('auth');

Route::post('objetivosestrategicos/reporte_pdf', [App\Http\Controllers\ObjetivosestrategicoController::class, 'reporte_pdf'])->name('objetivosestrategicos.reporte_pdf')->middleware('auth');

Route::resource('objetivosestrategicos', App\Http\Controllers\ObjetivosestrategicoController::class)->middleware('auth');


//reportes
Route::get('objetivonacionales/reportes', [App\Http\Controllers\ObjetivonacionaleController::class, 'reportes'])->name('objetivonacionales.reportes')->middleware('auth');

Route::post('objetivonacionales/reporte_pdf', [App\Http\Controllers\ObjetivonacionaleController::class, 'reporte_pdf'])->name('objetivonacionales.reporte_pdf')->middleware('auth');

Route::resource('objetivonacionales', App\Http\Controllers\ObjetivonacionaleController::class)->middleware('auth');


//reportes
Route::get('objetivopeis/reportes', [App\Http\Controllers\ObjetivopeiController::class, 'reportes'])->name('objetivopeis.reportes')->middleware('auth');

Route::post('objetivopeis/reporte_pdf', [App\Http\Controllers\ObjetivopeiController::class, 'reporte_pdf'])->name('objetivopeis.reporte_pdf')->middleware('auth');

Route::resource('objetivopeis', App\Http\Controllers\ObjetivopeiController::class)->middleware('auth');


//reportes
Route::get('unidadmedidas/reportes', [App\Http\Controllers\UnidadmedidaController::class, 'reportes'])->name('unidadmedidas.reportes')->middleware('auth');

Route::post('unidadmedidas/reporte_pdf', [App\Http\Controllers\UnidadmedidaController::class, 'reporte_pdf'])->name('unidadmedidas.reporte_pdf')->middleware('auth');

Route::resource('unidadmedidas', App\Http\Controllers\UnidadmedidaController::class)->middleware('auth');


//reportes
Route::get('clasificadorpresupuestarios/reportes', [App\Http\Controllers\ClasificadorpresupuestarioController::class, 'reportes'])->name('clasificadorpresupuestarios.reportes')->middleware('auth');

Route::post('clasificadorpresupuestarios/reporte_pdf', [App\Http\Controllers\ClasificadorpresupuestarioController::class, 'reporte_pdf'])->name('clasificadorpresupuestarios.reporte_pdf')->middleware('auth');

Route::resource('clasificadorpresupuestarios', App\Http\Controllers\ClasificadorpresupuestarioController::class)->middleware('auth');


//reportes
Route::get('productos/reportes', [App\Http\Controllers\ProductoController::class, 'reportes'])->name('productos.reportes')->middleware('auth');

Route::post('productos/reporte_pdf', [App\Http\Controllers\ProductoController::class, 'reporte_pdf'])->name('productos.reporte_pdf')->middleware('auth');

Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');


//reportes
Route::get('productoscps/reportes', [App\Http\Controllers\ProductoscpController::class, 'reportes'])->name('productoscps.reportes')->middleware('auth');

Route::post('productoscps/reporte_pdf', [App\Http\Controllers\ProductoscpController::class, 'reporte_pdf'])->name('productoscps.reporte_pdf')->middleware('auth');

Route::resource('productoscps', App\Http\Controllers\ProductoscpController::class)->middleware('auth');

//Route::resource('requisiciones', App\Http\Controllers\RequisicioneController::class)->middleware('auth');

//reportes
Route::get('poas/reportes', [App\Http\Controllers\PoaController::class, 'reportes'])->name('poas.reportes')->middleware('auth');

Route::post('poas/reporte_pdf', [App\Http\Controllers\PoaController::class, 'reporte_pdf'])->name('poas.reporte_pdf')->middleware('auth');


Route::resource('poas', App\Http\Controllers\PoaController::class)->middleware('auth');

//reportes
Route::get('metas/reportes', [App\Http\Controllers\MetaController::class, 'reportes'])->name('metas.reportes')->middleware('auth');

Route::post('metas/reporte_pdf', [App\Http\Controllers\MetaController::class, 'reporte_pdf'])->name('metas.reporte_pdf')->middleware('auth');

Route::resource('metas', App\Http\Controllers\MetaController::class)->middleware('auth');


//reportes
Route::get('ejercicios/reportes', [App\Http\Controllers\EjercicioController::class, 'reportes'])->name('ejercicios.reportes')->middleware('auth');

Route::post('ejercicios/reporte_pdf', [App\Http\Controllers\EjercicioController::class, 'reporte_pdf'])->name('ejercicios.reporte_pdf')->middleware('auth');

Route::resource('ejercicios', App\Http\Controllers\EjercicioController::class)->middleware('auth');


//reportes
Route::get('segmentos/reportes', [App\Http\Controllers\SegmentoController::class, 'reportes'])->name('segmentos.reportes')->middleware('auth');

Route::post('segmentos/reporte_pdf', [App\Http\Controllers\SegmentoController::class, 'reporte_pdf'])->name('segmentos.reporte_pdf')->middleware('auth');

Route::resource('segmentos', App\Http\Controllers\SegmentoController::class)->middleware('auth');


//reportes
Route::get('clases/reportes', [App\Http\Controllers\ClaseController::class, 'reportes'])->name('clases.reportes')->middleware('auth');

Route::post('clases/reporte_pdf', [App\Http\Controllers\ClaseController::class, 'reporte_pdf'])->name('clases.reporte_pdf')->middleware('auth');

Route::resource('clases', App\Http\Controllers\ClaseController::class)->middleware('auth');


//reportes
Route::get('unidadadministrativas/reportes', [App\Http\Controllers\UnidadadministrativaController::class, 'reportes'])->name('unidadadministrativas.reportes')->middleware('auth');

Route::post('unidadadministrativas/reporte_pdf', [App\Http\Controllers\UnidadadministrativaController::class, 'reporte_pdf'])->name('unidadadministrativas.reporte_pdf')->middleware('auth');

Route::resource('unidadadministrativas', App\Http\Controllers\UnidadadministrativaController::class)->middleware('auth');

Route::get('ejecuciones/formular', [App\Http\Controllers\EjecucioneController::class, 'formular'])->name('ejecuciones.formular')->middleware('auth');

Route::post('ejecuciones/store_formular', [App\Http\Controllers\EjecucioneController::class, 'store_formular'])->name('ejecuciones.store_formular')->middleware('auth');

Route::get('ejecuciones/create_formular', [App\Http\Controllers\EjecucioneController::class, 'create_formular'])->name('ejecuciones.create_formular')->middleware('auth');

Route::get('ejecuciones/pdf', [App\Http\Controllers\EjecucioneController::class, 'pdf'])->name('ejecuciones.pdf')->middleware('auth');


//reportes
Route::get('ejecuciones/reportes', [App\Http\Controllers\EjecucioneController::class, 'reportes'])->name('ejecuciones.reportes')->middleware('auth');

Route::post('ejecuciones/reporte_pdf', [App\Http\Controllers\EjecucioneController::class, 'reporte_pdf'])->name('ejecuciones.reporte_pdf')->middleware('auth');

Route::resource('ejecuciones', App\Http\Controllers\EjecucioneController::class)->middleware('auth');


//reportes
Route::get('objetivogenerales/reportes', [App\Http\Controllers\ObjetivogeneraleController::class, 'reportes'])->name('objetivogenerales.reportes')->middleware('auth');

Route::post('objetivogenerales/reporte_pdf', [App\Http\Controllers\ObjetivogeneraleController::class, 'reporte_pdf'])->name('objetivogenerales.reporte_pdf')->middleware('auth');

Route::resource('objetivogenerales', App\Http\Controllers\ObjetivogeneraleController::class)->middleware('auth');


//reportes
Route::get('objetivomunicipales/reportes', [App\Http\Controllers\ObjetivomunicipaleController::class, 'reportes'])->name('objetivomunicipales.reportes')->middleware('auth');

Route::post('objetivomunicipales/reporte_pdf', [App\Http\Controllers\ObjetivomunicipaleController::class, 'reporte_pdf'])->name('objetivomunicipales.reporte_pdf')->middleware('auth');

Route::resource('objetivomunicipales', App\Http\Controllers\ObjetivomunicipaleController::class)->middleware('auth');


//reportes
Route::get('familias/reportes', [App\Http\Controllers\FamiliaController::class, 'reportes'])->name('familias.reportes')->middleware('auth');

Route::post('familias/reporte_pdf', [App\Http\Controllers\FamiliaController::class, 'reporte_pdf'])->name('familias.reporte_pdf')->middleware('auth');

Route::resource('familias', App\Http\Controllers\FamiliaController::class)->middleware('auth');

Route::resource('tipodecompromisos', App\Http\Controllers\TipodecompromisoController::class)->middleware('auth');


//reportes
Route::get('beneficiarios/reportes', [App\Http\Controllers\BeneficiarioController::class, 'reportes'])->name('beneficiarios.reportes')->middleware('auth');

Route::post('beneficiarios/reporte_pdf', [App\Http\Controllers\BeneficiarioController::class, 'reporte_pdf'])->name('beneficiarios.reporte_pdf')->middleware('auth');


Route::resource('beneficiarios', App\Http\Controllers\BeneficiarioController::class)->middleware('auth');

Route::resource('proveedores', App\Http\Controllers\ProveedoreController::class)->middleware('auth');

Route::get('/ayudassociales/agregar/{ayuda}', [App\Http\Controllers\AyudassocialeController::class, 'agregar'])->name('ayudassociales.agregar')->middleware('auth');

Route::get('ayudassociales/procesadas', [App\Http\Controllers\AyudassocialeController::class, 'indexprocesadas'])->name('ayudassociales.procesadas')->middleware('auth');

Route::get('ayudassociales/anuladas', [App\Http\Controllers\AyudassocialeController::class, 'indexanuladas'])->name('ayudassociales.anuladas')->middleware('auth');

Route::get('ayudassociales/pdf/{ayuda}', [App\Http\Controllers\AyudassocialeController::class, 'pdf'])->name('ayudassociales.pdf')->middleware('auth');

Route::patch('/ayudassociales/aprobar/{ayuda}', [App\Http\Controllers\AyudassocialeController::class, 'aprobar'])->name('ayudassociales.aprobar')->middleware('auth');

Route::patch('/ayudassociales/anular/{ayuda}', [App\Http\Controllers\AyudassocialeController::class, 'anular'])->name('ayudassociales.anular')->middleware('auth');

Route::patch('/ayudassociales/modificar/{ayuda}', [App\Http\Controllers\AyudassocialeController::class, 'modificar'])->name('ayudassociales.modificar')->middleware('auth');

Route::get('ayudassociales/procesadas', [App\Http\Controllers\AyudassocialeController::class, 'indexprocesadas'])->name('ayudassociales.procesadas')->middleware('auth');

Route::get('ayudassociales/anuladas', [App\Http\Controllers\AyudassocialeController::class, 'indexanuladas'])->name('ayudassociales.anuladas')->middleware('auth');

Route::get('ayudassociales/aprobadas', [App\Http\Controllers\AyudassocialeController::class, 'indexaprobadas'])->name('ayudassociales.aprobadas')->middleware('auth');

Route::get('ayudassociales/reportes', [App\Http\Controllers\AyudassocialeController::class, 'reportes'])->name('ayudassociales.reportes')->middleware('auth');

Route::post('ayudassociales/reporte_pdf', [App\Http\Controllers\AyudassocialeController::class, 'reporte_pdf'])->name('ayudassociales.reporte_pdf')->middleware('auth');

Route::resource('ayudassociales', App\Http\Controllers\AyudassocialeController::class)->middleware('auth');

Route::resource('criterios', App\Http\Controllers\CriterioController::class)->middleware('auth');

Route::get('/analisis/agregar/{analisi}', [App\Http\Controllers\AnalisiController::class, 'agregar'])->name('analisis.agregar')->middleware('auth');



Route::patch('/analisis/aprobar/{analisi}', [App\Http\Controllers\AnalisiController::class, 'aprobar'])->name('analisis.aprobar')->middleware('auth');

Route::get('analisis/procesadas', [App\Http\Controllers\AnalisiController::class, 'indexprocesadas'])->name('analisis.procesadas')->middleware('auth');

Route::get('analisis/aprobadas', [App\Http\Controllers\AnalisiController::class, 'indexaprobadas'])->name('analisis.aprobadas')->middleware('auth');

Route::get('analisis/anuladas', [App\Http\Controllers\AnalisiController::class, 'indexanuladas'])->name('analisis.anuladas')->middleware('auth');

Route::patch('/analisis/anular/{analisi}', [App\Http\Controllers\AnalisiController::class, 'anular'])->name('analisis.anular')->middleware('auth');

Route::patch('/analisis/modificar/{analisi}', [App\Http\Controllers\AnalisiController::class, 'modificar'])->name('analisis.modificar')->middleware('auth');

Route::get('analisis/pdf/{analisi}', [App\Http\Controllers\AnalisiController::class, 'pdf'])->name('analisis.pdf')->middleware('auth');

//rutas para los select dinamicos
Route::get('welcome', [App\Http\Controllers\AnalisiController::class, 'welcome'])->name('welcome')->middleware('auth');

Route::post('analisis/requisicion', [App\Http\Controllers\AnalisiController::class, 'requisicion']);

Route::post('analisis/{analisis}/requisicion', [App\Http\Controllers\AnalisiController::class, 'requisicion']);

Route::get('analisis/reportes', [App\Http\Controllers\AnalisiController::class, 'reportes'])->name('analisis.reportes')->middleware('auth');

Route::post('analisis/reporte_pdf', [App\Http\Controllers\AnalisiController::class, 'reporte_pdf'])->name('analisis.reporte_pdf')->middleware('auth');


Route::resource('analisis', App\Http\Controllers\AnalisiController::class)->middleware('auth');

Route::post('/detallesanalisis/storedos', [App\Http\Controllers\DetallesanalisiController::class, 'storedos'])->name('detallesanalisis.storedos')->middleware('auth');

Route::post('/detallesanalisis/storetres', [App\Http\Controllers\DetallesanalisiController::class, 'storetres'])->name('detallesanalisis.storetres')->middleware('auth');

Route::get('/detallesanalisis/createwithbos/{analisi}', [App\Http\Controllers\DetallesanalisiController::class, 'createwithbos'])->name('detallesanalisis.createwithbos')->middleware('auth');


Route::resource('detallesanalisis', App\Http\Controllers\DetallesanalisiController::class)->middleware('auth');

Route::get('/compras/agregar/{compra}', [App\Http\Controllers\CompraController::class, 'agregarcompra'])->name('compras.agregarcompra')->middleware('auth');

Route::patch('/compras/aprobar/{compra}', [App\Http\Controllers\CompraController::class, 'aprobar'])->name('compras.aprobar')->middleware('auth');

Route::get('/compras/reversar/{analisi}', [App\Http\Controllers\CompraController::class, 'reversar'])->name('compras.reversar')->middleware('auth');

Route::get('compras/aprobadas', [App\Http\Controllers\CompraController::class, 'indexaprobadas'])->name('compras.aprobadas')->middleware('auth');

Route::get('compras/procesadas', [App\Http\Controllers\CompraController::class, 'indexprocesadas'])->name('compras.procesadas')->middleware('auth');

Route::get('compras/anuladas', [App\Http\Controllers\CompraController::class, 'indexanuladas'])->name('compras.anuladas')->middleware('auth');

Route::patch('/compras/actualizar/{compra}', [App\Http\Controllers\CompraController::class, 'actualizar'])->name('compras.actualizar')->middleware('auth');

Route::patch('/compras/anular/{compra}', [App\Http\Controllers\CompraController::class, 'anular'])->name('compras.anular')->middleware('auth');

Route::patch('/compras/modificar/{compra}', [App\Http\Controllers\CompraController::class, 'modificar'])->name('compras.modificar')->middleware('auth');

Route::get('compras/analisis', [App\Http\Controllers\CompraController::class, 'indexanalisis'])->name('compras.analisis')->middleware('auth');

Route::get('compras/pdf/{compra}', [App\Http\Controllers\CompraController::class, 'pdf'])->name('compras.pdf')->middleware('auth');

Route::get('compras/reportes', [App\Http\Controllers\CompraController::class, 'reportes'])->name('compras.reportes')->middleware('auth');

Route::post('compras/reporte_pdf', [App\Http\Controllers\CompraController::class, 'reporte_pdf'])->name('compras.reporte_pdf')->middleware('auth');


Route::resource('compras', App\Http\Controllers\CompraController::class)->middleware('auth');

Route::resource('comprascps', App\Http\Controllers\ComprascpController::class)->middleware('auth');

Route::resource('detallesrequisiciones', App\Http\Controllers\DetallesrequisicioneController::class)->middleware('auth');

Route::get('/requisiciones/agregar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'agregar'])->name('requisiciones.agregar')->middleware('auth');

Route::get('requisiciones/pdf/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'pdf'])->name('requisiciones.pdf')->middleware('auth');


Route::get('requisiciones/pdfdepurar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'pdfdepurar'])->name('requisiciones.pdfdepurar')->middleware('auth');

Route::get('requisiciones/procesadas', [App\Http\Controllers\RequisicioneController::class, 'indexprocesadas'])->name('requisiciones.procesadas')->middleware('auth');

Route::get('requisiciones/reportes', [App\Http\Controllers\RequisicioneController::class, 'reportes'])->name('requisiciones.reportes')->middleware('auth');

Route::post('requisiciones/reporte_pdf', [App\Http\Controllers\RequisicioneController::class, 'reporte_pdf'])->name('requisiciones.reporte_pdf')->middleware('auth');

Route::get('requisiciones/anuladas', [App\Http\Controllers\RequisicioneController::class, 'indexanuladas'])->name('requisiciones.anuladas')->middleware('auth');

Route::get('requisiciones/aprobadas', [App\Http\Controllers\RequisicioneController::class, 'indexaprobadas'])->name('requisiciones.aprobadas')->middleware('auth');

Route::patch('/requisiciones/anular/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'anular'])->name('requisiciones.anular')->middleware('auth');

Route::patch('/requisiciones/reversar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'reversar'])->name('requisiciones.reversar')->middleware('auth');

Route::patch('/requisiciones/aprobar/{requisicione}', [App\Http\Controllers\RequisicioneController::class, 'aprobar'])->name('requisiciones.aprobar')->middleware('auth');

Route::resource('requisiciones', App\Http\Controllers\RequisicioneController::class)->middleware('auth');

Route::get('ordenpagos/compromisos', [App\Http\Controllers\OrdenpagoController::class, 'indexcompromisos'])->name('ordenpagos.compromisos')->middleware('auth');

Route::get('/ordenpagos/agregar/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'agregarordenpago'])->name('ordenpagos.agregarordenpago')->middleware('auth');

Route::get('/ordenpagos/retencion/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'agregar'])->name('ordenpagos.agregar')->middleware('auth');
//para agregar las facturas a las orden de pagos en proceso
Route::get('/ordenpagos/facturas/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'agregarfacturas'])->name('ordenpagos.agregarfacturas')->middleware('auth');

Route::get('/ordenpagos/reversar/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'reversar'])->name('ordenpagos.reversar')->middleware('auth');

Route::get('ordenpagos/pdf/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'pdf'])->name('ordenpagos.pdf')->middleware('auth');

Route::patch('/ordenpagos/aprobar/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'aprobar'])->name('ordenpagos.aprobar')->middleware('auth');

Route::get('ordenpagos/aprobadas', [App\Http\Controllers\OrdenpagoController::class, 'indexaprobadas'])->name('ordenpagos.aprobados')->middleware('auth');

Route::get('ordenpagos/procesados', [App\Http\Controllers\OrdenpagoController::class, 'indexprocesadas'])->name('ordenpagos.procesados')->middleware('auth');

Route::get('ordenpagos/financieras', [App\Http\Controllers\OrdenpagoController::class, 'indexfinancieras'])->name('ordenpagos.financieras')->middleware('auth');

Route::get('ordenpagos/conimputacion', [App\Http\Controllers\OrdenpagoController::class, 'indexconimputacion'])->name('ordenpagos.conimputacion')->middleware('auth');

Route::get('ordenpagos/anulados', [App\Http\Controllers\OrdenpagoController::class, 'indexanuladas'])->name('ordenpagos.anulados')->middleware('auth');

Route::patch('/ordenpagos/anular/{ordenpago}', [App\Http\Controllers\OrdenpagoController::class, 'anular'])->name('ordenpagos.anular')->middleware('auth');

Route::get('ordenpagos/crear', [App\Http\Controllers\OrdenpagoController::class, 'crearfinanciera'])->name('ordenpagos.crear')->middleware('auth');

Route::post('ordenpagos/storefinanciera', [App\Http\Controllers\OrdenpagoController::class, 'storefinanciera'])->name('ordenpagos.storefinanciera')->middleware('auth');


//reportes
Route::get('ordenpagos/reportes', [App\Http\Controllers\OrdenpagoController::class, 'reportes'])->name('ordenpagos.reportes')->middleware('auth');

Route::post('ordenpagos/reporte_pdf', [App\Http\Controllers\OrdenpagoController::class, 'reporte_pdf'])->name('ordenpagos.reporte_pdf')->middleware('auth');


Route::resource('ordenpagos', App\Http\Controllers\OrdenpagoController::class)->middleware('auth');

Route::resource('detalleretenciones', App\Http\Controllers\DetalleretencioneController::class)->middleware('auth');

Route::resource('tiporetenciones', App\Http\Controllers\TiporetencioneController::class)->middleware('auth');

Route::resource('retenciones', App\Http\Controllers\RetencioneController::class)->middleware('auth');

Route::resource('bancos', App\Http\Controllers\BancoController::class)->middleware('auth');
//reportes
Route::get('cuentasbancarias/reportes', [App\Http\Controllers\CuentasbancariaController::class, 'reportes'])->name('cuentasbancarias.reportes')->middleware('auth');

Route::post('cuentasbancarias/reporte_pdf', [App\Http\Controllers\CuentasbancariaController::class, 'reporte_pdf'])->name('cuentasbancarias.reporte_pdf')->middleware('auth');


Route::resource('cuentasbancarias', App\Http\Controllers\CuentasbancariaController::class)->middleware('auth');

Route::resource('tipomovimientos', App\Http\Controllers\TipomovimientoController::class)->middleware('auth');

//Route::resource('notacreditos', App\Http\Controllers\NotacreditoController::class)->middleware('auth');

Route::resource('movimientosbancarios', App\Http\Controllers\MovimientosbancarioController::class)->middleware('auth');

Route::resource('detallepagados', App\Http\Controllers\DetallepagadoController::class)->middleware('auth');

Route::get('/pagados/agregar', [App\Http\Controllers\PagadoController::class, 'agregar'])->name('pagados.agregar')->middleware('auth');

//Route::get('/pagados/agregarordendepago/', [App\Http\Controllers\PagadoController::class, 'agregarordendepago'])->name('pagados.agregarordendepago')->middleware('auth');

Route::get('pagados/pdf/{pagado}', [App\Http\Controllers\PagadoController::class, 'pdf'])->name('pagados.pdf')->middleware('auth');

Route::get('pagados/procesados', [App\Http\Controllers\PagadoController::class, 'indexprocesadas'])->name('pagados.procesados')->middleware('auth');

Route::get('pagados/aprobadas', [App\Http\Controllers\PagadoController::class, 'indexaprobadas'])->name('pagados.aprobadas')->middleware('auth');

Route::get('pagados/anulados', [App\Http\Controllers\PagadoController::class, 'indexanuladas'])->name('pagados.anulados')->middleware('auth');

Route::patch('/pagados/anular/{pagado}', [App\Http\Controllers\PagadoController::class, 'anular'])->name('pagados.anular')->middleware('auth');

Route::get('/pagados/reversar/{pagado}', [App\Http\Controllers\PagadoController::class, 'reversar'])->name('pagados.reversar')->middleware('auth');

Route::get('/pagados/actualizar/{pagado}', [App\Http\Controllers\PagadoController::class, 'actualizar'])->name('pagados.actualizar')->middleware('auth');

Route::patch('/pagados/aprobar/{pagado}', [App\Http\Controllers\PagadoController::class, 'aprobar'])->name('pagados.aprobar')->middleware('auth');

Route::get('/pagados/agregarorden/{pagado}', [App\Http\Controllers\PagadoController::class, 'agregarorden'])->name('pagados.agregarorden')->middleware('auth');

Route::get('/pagados/agregartransferencia/{pagado}', [App\Http\Controllers\PagadoController::class, 'agregartransferencia'])->name('pagados.agregartransferencia')->middleware('auth');


//reportes
Route::get('pagados/reportes', [App\Http\Controllers\PagadoController::class, 'reportes'])->name('pagados.reportes')->middleware('auth');

Route::post('pagados/reporte_pdf', [App\Http\Controllers\PagadoController::class, 'reporte_pdf'])->name('pagados.reporte_pdf')->middleware('auth');


Route::resource('pagados', App\Http\Controllers\PagadoController::class)->middleware('auth');

Route::get('compromisos/compras', [App\Http\Controllers\CompromisoController::class, 'indexcompras'])->name('compromisos.compras')->middleware('auth');

Route::patch('/compromisos/actualizar/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'actualizar'])->name('compromisos.actualizar')->middleware('auth');

Route::get('/compromisos/agregar/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'agregarcompromiso'])->name('compromisos.agregarcompromiso')->middleware('auth');

Route::get('/compromisos/agregarayuda/{ayuda}', [App\Http\Controllers\CompromisoController::class, 'agregarayuda'])->name('compromisos.agregarayuda')->middleware('auth');

Route::get('/compromisos/reversarayuda/{ayuda}', [App\Http\Controllers\CompromisoController::class, 'reversarayuda'])->name('compromisos.reversarayuda')->middleware('auth');

Route::get('/compromisos/reversar/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'reversar'])->name('compromisos.reversar')->middleware('auth');

Route::get('compromisos/pdf/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'pdf'])->name('compromisos.pdf')->middleware('auth');

Route::patch('/compromisos/aprobar/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'aprobar'])->name('compromisos.aprobar')->middleware('auth');

Route::get('compromisos/procesados', [App\Http\Controllers\CompromisoController::class, 'indexprocesadas'])->name('compromisos.procesados')->middleware('auth');

Route::get('compromisos/anulados', [App\Http\Controllers\CompromisoController::class, 'indexanuladas'])->name('compromisos.anulados')->middleware('auth');

Route::patch('/compromisos/anular/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'anular'])->name('compromisos.anular')->middleware('auth');

Route::post('compromisos/storeayuda', [App\Http\Controllers\CompromisoController::class, 'storeayuda'])->name('compromisos.storeayuda')->middleware('auth');

Route::post('compromisos/storeprecompromiso', [App\Http\Controllers\CompromisoController::class, 'storeprecompromiso'])->name('compromisos.storeprecompromiso')->middleware('auth');

Route::get('/compromisos/agregarprecompromiso/{precompromiso}', [App\Http\Controllers\CompromisoController::class, 'agregarprecompromiso'])->name('compromisos.agregarprecompromiso')->middleware('auth');

Route::get('/compromisos/reversarprecompromiso/{precompromiso}', [App\Http\Controllers\CompromisoController::class, 'reversarprecompromiso'])->name('compromisos.reversarprecompromiso')->middleware('auth');

Route::get('compromisos/aprobadas', [App\Http\Controllers\CompromisoController::class, 'indexaprobadas'])->name('compromisos.aprobadas')->middleware('auth');

Route::get('/compromisos/modificar/{compromiso}', [App\Http\Controllers\CompromisoController::class, 'modificar'])->name('compromisos.modificar')->middleware('auth');

//reportes
Route::get('compromisos/reportes', [App\Http\Controllers\CompromisoController::class, 'reportes'])->name('compromisos.reportes')->middleware('auth');

Route::post('compromisos/reporte_pdf', [App\Http\Controllers\CompromisoController::class, 'reporte_pdf'])->name('compromisos.reporte_pdf')->middleware('auth');


Route::resource('compromisos', App\Http\Controllers\CompromisoController::class)->middleware('auth');

Route::resource('detallescompromisos', App\Http\Controllers\DetallescompromisoController::class)->middleware('auth');

Route::get('ajustescompromisos/agregar', [App\Http\Controllers\AjustescompromisoController::class, 'agregar'])->name('ajustescompromisos.agregar')->middleware('auth');

Route::get('ajustescompromisos/procesadas', [App\Http\Controllers\AjustescompromisoController::class, 'indexprocesadas'])->name('ajustescompromisos.procesadas')->middleware('auth');

Route::get('ajustescompromisos/anuladas', [App\Http\Controllers\AjustescompromisoController::class, 'indexanuladas'])->name('ajustescompromisos.anuladas')->middleware('auth');

Route::get('ajustescompromisos/pdf/{ajuste}', [App\Http\Controllers\AjustescompromisoController::class, 'pdf'])->name('ajustescompromisos.pdf')->middleware('auth');

Route::patch('/ajustescompromisos/aprobar/{ajuste}', [App\Http\Controllers\AjustescompromisoController::class, 'aprobar'])->name('ajustescompromisos.aprobar')->middleware('auth');

Route::patch('/ajustescompromisos/reversar/{ajuste}', [App\Http\Controllers\AjustescompromisoController::class, 'reversar'])->name('ajustescompromisos.reversar')->middleware('auth');

Route::patch('/ajustescompromisos/anular/{ajuste}', [App\Http\Controllers\AjustescompromisoController::class, 'anular'])->name('ajustescompromisos.anular')->middleware('auth');

Route::get('ajustescompromisos/procesados', [App\Http\Controllers\AjustescompromisoController::class, 'indexprocesadas'])->name('ajustescompromisos.procesadas')->middleware('auth');

Route::get('ajustescompromisos/anulados', [App\Http\Controllers\AjustescompromisoController::class, 'indexanuladas'])->name('ajustescompromisos.anuladas')->middleware('auth');

Route::get('/ajustescompromisos/agregarcompromiso/{ajustecompromiso}', [App\Http\Controllers\AjustescompromisoController::class, 'agregarcompromiso'])->name('ajustescompromisos.agregarcompromiso')->middleware('auth');


//reportes
Route::get('ajustescompromisos/reportes', [App\Http\Controllers\AjustescompromisoController::class, 'reportes'])->name('ajustescompromisos.reportes')->middleware('auth');

Route::post('ajustescompromisos/reporte_pdf', [App\Http\Controllers\AjustescompromisoController::class, 'reporte_pdf'])->name('ajustescompromisos.reporte_pdf')->middleware('auth');


Route::resource('ajustescompromisos', App\Http\Controllers\AjustescompromisoController::class)->middleware('auth');

Route::get('/modificaciones/agregar/{modificacion}', [App\Http\Controllers\ModificacioneController::class, 'agregarmodificacion'])->name('modificaciones.agregarmodificacion')->middleware('auth');

Route::patch('/modificaciones/aprobar/{modificacion}', [App\Http\Controllers\ModificacioneController::class, 'aprobar'])->name('modificaciones.aprobar')->middleware('auth');

Route::patch('/modificaciones/anular/{modificacion}', [App\Http\Controllers\ModificacioneController::class, 'anular'])->name('modificaciones.anular')->middleware('auth');

Route::get('modificaciones/procesadas', [App\Http\Controllers\ModificacioneController::class, 'indexprocesadas'])->name('modificaciones.procesadas')->middleware('auth');

Route::get('modificaciones/anuladas', [App\Http\Controllers\ModificacioneController::class, 'indexanuladas'])->name('modificaciones.anuladas')->middleware('auth');

Route::get('modificaciones/pdf/{modificacion}', [App\Http\Controllers\ModificacioneController::class, 'pdf'])->name('modificaciones.pdf')->middleware('auth');

Route::get('/modificaciones/reversar/{modificacion}', [App\Http\Controllers\ModificacioneController::class, 'reversar'])->name('modificaciones.reversar')->middleware('auth');


//reportes
Route::get('modificaciones/reportes', [App\Http\Controllers\ModificacioneController::class, 'reportes'])->name('modificaciones.reportes')->middleware('auth');

Route::post('modificaciones/reporte_pdf', [App\Http\Controllers\ModificacioneController::class, 'reporte_pdf'])->name('modificaciones.reporte_pdf')->middleware('auth');

Route::resource('modificaciones', App\Http\Controllers\ModificacioneController::class)->middleware('auth');

Route::resource('tipomodificaciones', App\Http\Controllers\TipomodificacioneController::class)->middleware('auth');

Route::post('detallesmodificaciones/ejecucionmod', [App\Http\Controllers\DetallesmodificacioneController::class, 'ejecucionmod']);

Route::post('detallesmodificaciones/{detmod}/ejecucionmod', [App\Http\Controllers\DetallesmodificacioneController::class, 'ejecucionmod']);

Route::resource('detallesmodificaciones', App\Http\Controllers\DetallesmodificacioneController::class)->middleware('auth');

Route::post('detallesayudas/ejecucion', [App\Http\Controllers\DetallesayudaController::class, 'ejecucion']);

Route::post('detallesayudas/{ayuda}/ejecucion', [App\Http\Controllers\DetallesayudaController::class, 'ejecucion']);

Route::resource('detallesayudas', App\Http\Controllers\DetallesayudaController::class)->middleware('auth');

Route::get('/precompromisos/agregar/{precompromiso}', [App\Http\Controllers\PrecompromisoController::class, 'agregar'])->name('precompromisos.agregar')->middleware('auth');

Route::patch('/precompromisos/aprobar/{precompromiso}', [App\Http\Controllers\PrecompromisoController::class, 'aprobar'])->name('precompromisos.aprobar')->middleware('auth');

Route::patch('/precompromisos/modificar/{precompromiso}', [App\Http\Controllers\PrecompromisoController::class, 'modificar'])->name('precompromisos.modificar')->middleware('auth');


Route::patch('/precompromisos/anular/{precompromiso}', [App\Http\Controllers\PrecompromisoController::class, 'anular'])->name('precompromisos.anular')->middleware('auth');

Route::get('precompromisos/aprobadas', [App\Http\Controllers\PrecompromisoController::class, 'indexaprobadas'])->name('precompromisos.aprobadas')->middleware('auth');

Route::get('precompromisos/procesadas', [App\Http\Controllers\PrecompromisoController::class, 'indexprocesadas'])->name('precompromisos.procesadas')->middleware('auth');

Route::get('precompromisos/anuladas', [App\Http\Controllers\PrecompromisoController::class, 'indexanuladas'])->name('precompromisos.anuladas')->middleware('auth');

Route::get('/precompromisos/pdf/{precompromiso}', [App\Http\Controllers\PrecompromisoController::class, 'pdf'])->name('precompromisos.pdf')->middleware('auth');

//reportes
Route::get('precompromisos/reportes', [App\Http\Controllers\PrecompromisoController::class, 'reportes'])->name('precompromisos.reportes')->middleware('auth');

Route::post('precompromisos/reporte_pdf', [App\Http\Controllers\PrecompromisoController::class, 'reporte_pdf'])->name('precompromisos.reporte_pdf')->middleware('auth');


Route::resource('precompromisos', App\Http\Controllers\PrecompromisoController::class)->middleware('auth');

Route::post('detallesprecompromisos/ejecucionpre', [App\Http\Controllers\DetallesprecompromisoController::class, 'ejecucionpre']);

Route::post('detallesprecompromisos/{precompromiso}/ejecucionpre', [App\Http\Controllers\DetallesprecompromisoController::class, 'ejecucionpre']);

Route::resource('detallesprecompromisos', App\Http\Controllers\DetallesprecompromisoController::class)->middleware('auth');




//Route::resource('notadebitos', App\Http\Controllers\NotadebitoController::class)->middleware('auth');

Route::get('transferencias/pdf/{transf}', [App\Http\Controllers\TransferenciaController::class, 'pdf'])->name('transferencias.pdf')->middleware('auth');

Route::get('transferencias/reversar/{transf}', [App\Http\Controllers\TransferenciaController::class, 'reversar'])->name('transferencias.reversar')->middleware('auth');


Route::get('transferencias/miagregar', [App\Http\Controllers\TransferenciaController::class, 'miagregar'])->name('transferencias.miagregar')->middleware('auth');

Route::get('/transferencias/seleccionarpagado/{pagado}', [App\Http\Controllers\TransferenciaController::class, 'seleccionarpagado'])->name('transferencias.seleccionarpagado')->middleware('auth');


Route::get('transferencias/procesados', [App\Http\Controllers\TransferenciaController::class, 'indexprocesadas'])->name('transferencias.procesados')->middleware('auth');

Route::get('transferencias/anulados', [App\Http\Controllers\TransferenciaController::class, 'indexanuladas'])->name('transferencias.anulados')->middleware('auth');


Route::get('/transferencias/agregar', [App\Http\Controllers\TransferenciaController::class, 'agregar'])->name('transferencias.agregar')->middleware('auth');

Route::get('/transferencias/agregartransferencia', [App\Http\Controllers\TransferenciaController::class, 'agregartransferencia'])->name('transferencias.agregartransferencia')->middleware('auth');

//reportes
Route::get('transferencias/reportes', [App\Http\Controllers\TransferenciaController::class, 'reportes'])->name('transferencias.reportes')->middleware('auth');

Route::post('transferencias/reporte_pdf', [App\Http\Controllers\TransferenciaController::class, 'reporte_pdf'])->name('transferencias.reporte_pdf')->middleware('auth');


Route::resource('transferencias', App\Http\Controllers\TransferenciaController::class)->middleware('auth');

Route::resource('facturas', App\Http\Controllers\FacturaController::class)->middleware('auth');

Route::post('notasdecreditos/cuentas', [App\Http\Controllers\NotasdecreditoController::class, 'cuentas']);

Route::post('notasdecreditos/{notas}/cuentas', [App\Http\Controllers\NotasdecreditoController::class, 'cuentas']);

Route::get('notasdecreditos/pdf/{transf}', [App\Http\Controllers\NotasdecreditoController::class, 'pdf'])->name('notasdecreditos.pdf')->middleware('auth');

//reportes
Route::get('notasdecreditos/reportes', [App\Http\Controllers\NotasdecreditoController::class, 'reportes'])->name('notasdecreditos.reportes')->middleware('auth');

Route::post('notasdecreditos/reporte_pdf', [App\Http\Controllers\NotasdecreditoController::class, 'reporte_pdf'])->name('notasdecreditos.reporte_pdf')->middleware('auth');


Route::resource('notasdecreditos', App\Http\Controllers\NotasdecreditoController::class)->middleware('auth');

Route::post('notasdedebitos/cuentasdeb', [App\Http\Controllers\NotasdedebitoController::class, 'cuentasdeb']);

Route::post('notasdedebitos/{notas}/cuentasdeb', [App\Http\Controllers\NotasdedebitoController::class, 'cuentasdeb']);

Route::get('notasdedebitos/pdf/{transf}', [App\Http\Controllers\NotasdedebitoController::class, 'pdf'])->name('notasdedebitos.pdf')->middleware('auth');

//reportes
Route::get('notasdedebitos/reportes', [App\Http\Controllers\NotasdedebitoController::class, 'reportes'])->name('notasdedebitos.reportes')->middleware('auth');

Route::post('notasdedebitos/reporte_pdf', [App\Http\Controllers\NotasdedebitoController::class, 'reporte_pdf'])->name('notasdedebitos.reporte_pdf')->middleware('auth');


Route::resource('notasdedebitos', App\Http\Controllers\NotasdedebitoController::class)->middleware('auth');

Route::post('transferenciaentrecuentas/cuentasdestino', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'cuentasdestino']);

Route::post('transferenciaentrecuentas/{transferencia}/cuentasdestino', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'cuentasdestino']);

Route::post('transferenciaentrecuentas/cuentasorigen', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'cuentasorigen']);

Route::post('transferenciaentrecuentas/{transferencia}/cuentasorigen', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'cuentasorigen']);

Route::get('transferenciaentrecuentas/pdf/{transf}', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'pdf'])->name('transferenciaentrecuentas.pdf')->middleware('auth');

//reportes
Route::get('transferenciaentrecuentas/reportes', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'reportes'])->name('transferenciaentrecuentas.reportes')->middleware('auth');

Route::post('transferenciaentrecuentas/reporte_pdf', [App\Http\Controllers\TransferenciaentrecuentaController::class, 'reporte_pdf'])->name('transferenciaentrecuentas.reporte_pdf')->middleware('auth');



Route::resource('transferenciaentrecuentas', App\Http\Controllers\TransferenciaentrecuentaController::class)->middleware('auth');

Route::get('comprobantesretenciones/islrpdf/{comprobante}', [App\Http\Controllers\ComprobantesretencioneController::class, 'islrpdf'])->name('comprobantesretenciones.islrpdf')->middleware('auth');

//reportes
Route::get('comprobantesretenciones/reportes', [App\Http\Controllers\ComprobantesretencioneController::class, 'reportes'])->name('comprobantesretenciones.reportes')->middleware('auth');

Route::post('comprobantesretenciones/reporte_pdf', [App\Http\Controllers\ComprobantesretencioneController::class, 'reporte_pdf'])->name('comprobantesretenciones.reporte_pdf')->middleware('auth');

Route::resource('comprobantesretenciones', App\Http\Controllers\ComprobantesretencioneController::class)->middleware('auth');

Route::resource('detallesajustes', App\Http\Controllers\DetallesajusteController::class)->middleware('auth');

Route::resource('configuraciones', App\Http\Controllers\ConfiguracioneController::class)->middleware('auth');

//INICIO SISTEMA SIMBAD
Route::get('empleados/carnet/{id}', [App\Http\Controllers\EmpleadoController::class, 'carnet'])->name('empleados.carnet')->middleware('auth');
Route::get('hijos/carnet/{id}', [App\Http\Controllers\HijoController::class, 'carnet'])->name('hijos.carnet')->middleware('auth');

Route::resource('gabinetes', App\Http\Controllers\GabineteController::class)->middleware('auth');
Route::resource('unidades', App\Http\Controllers\UnidadeController::class)->middleware('auth');
Route::resource('empleados', App\Http\Controllers\EmpleadoController::class)->middleware('auth');
Route::resource('hijos', App\Http\Controllers\HijoController::class)->middleware('auth');
Route::resource('eventos', App\Http\Controllers\EventoController::class)->middleware('auth');
Route::resource('asistencias', App\Http\Controllers\AsistenciaController::class)->middleware('auth');




