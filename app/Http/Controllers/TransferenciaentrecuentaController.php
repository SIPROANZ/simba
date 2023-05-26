<?php

namespace App\Http\Controllers;

use App\Transferenciaentrecuenta;
use App\Banco;
use App\Cuentasbancaria;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

use App\Transferencia;
use App\Beneficiario;
use App\Models\User;

/**
 * Class TransferenciaentrecuentaController
 * @package App\Http\Controllers
 */
class TransferenciaentrecuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.pagados')->only('index', 'edit', 'update', 'create', 'store', 'pdf');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $transferenciaentrecuentas = Transferenciaentrecuenta::paginate();

        $transferenciaentrecuentas = Transferenciaentrecuenta::query()
        ->when(request('search'), function($query){
            return $query->where('descripcion', 'like', '%'.request('search').'%')
                           ->orWhereHas('usuario', function($qa){
                             $qa->where('name', 'like', '%'.request('search').'%');
                         })->orderBy('id', 'DESC');
         },
         function ($query) {
             $query->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('transferenciaentrecuenta.index', compact('transferenciaentrecuentas'))
            ->with('i', (request()->input('page', 1) - 1) * $transferenciaentrecuentas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transferenciaentrecuenta = new Transferenciaentrecuenta();

        $bancos = Banco::all();
        $bancosdestino = Banco::all();
        return view('transferenciaentrecuenta.create', compact('transferenciaentrecuenta', 'bancos', 'bancosdestino'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Transferenciaentrecuenta::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        
        $cuentaorigen = Cuentasbancaria::find($request->cuentaorigen_id);
        $cuentadestino = Cuentasbancaria::find($request->cuentadestino_id);
        $montosaldo = $cuentaorigen->montosaldo;

        $validar = Transferenciaentrecuenta::where('cuentaorigen_id', $request->cuentaorigen_id)->where('referencia', $request->referencia)->exists();


        if($validar!=true){ 

        if($request->monto>$montosaldo) {
            return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Error: El monto a transferir es mayor al saldo de la cuenta bancaria de origen.');
        
        }else{
           

            $transferenciaentrecuenta = Transferenciaentrecuenta::create($request->all());
            $cuentaorigen->decrement('montosaldo', $request->monto); //resto de la cuenta origen
            $cuentadestino->increment('montosaldo', $request->monto); //lo aumento en la cuenta destino

            return redirect()->route('transferenciaentrecuentas.index')
                ->with('success', 'Transferencia entre cuenta creada satisfactoriamente.');

        }
    }else{
        return redirect()->route('transferenciaentrecuentas.index')
                ->with('success', 'Error: La referencia bancaria se encuentra repetida en el sistema.');
    }




       
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        return view('transferenciaentrecuenta.show', compact('transferenciaentrecuenta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        $bancos = Banco::all();
        $bancosdestino = Banco::all();

        return view('transferenciaentrecuenta.edit', compact('transferenciaentrecuenta', 'bancos', 'bancosdestino'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Transferenciaentrecuenta $transferenciaentrecuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transferenciaentrecuenta $transferenciaentrecuenta)
    {
        request()->validate(Transferenciaentrecuenta::$rules);

         //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
         $cuentabancaria = Cuentasbancaria::find($transferenciaentrecuenta->cuentaorigen_id);
         $cuentabancariadestino = Cuentasbancaria::find($transferenciaentrecuenta->cuentadestino_id);
         $montoviejo = $transferenciaentrecuenta->monto;
         $montonuevo = $request->monto;
 
         if($montonuevo>($montoviejo + $cuentabancaria->montosaldo) ) {
            return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Error: No se ha podido actualizar, porque el nuevo monto es mayor al saldo de la cuenta bancaria de origen');
        }else{
           //Obtener el banco al cual quiero actualizar el valor
         $cuentabancaria->increment('montosaldo', $montoviejo);
         $cuentabancaria->decrement('montosaldo', $montonuevo);
         $cuentabancariadestino->decrement('montosaldo', $montoviejo);
         $cuentabancariadestino->increment('montosaldo', $montonuevo);

         $transferenciaentrecuenta->update($request->all());

        return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Transferencia entre cuentas actualizada satisfactoriamente');

        }

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);

        $cuentaorigen = Cuentasbancaria::find($transferenciaentrecuenta->cuentaorigen_id);
        $cuentaorigen->increment('montosaldo', $transferenciaentrecuenta->monto);

        $cuentadestino = Cuentasbancaria::find($transferenciaentrecuenta->cuentadestino_id);
        $cuentadestino->decrement('montosaldo', $transferenciaentrecuenta->monto);

        $transferenciaentrecuenta->delete();

        return redirect()->route('transferenciaentrecuentas.index')
            ->with('success', 'Transferencia entre cuenta eliminada satisfactoriamente');
    }

    public function cuentasorigen(Request $request){
        if(isset($request->texto)){
            $cuentasbancarias = Cuentasbancaria::where('banco_id', $request->texto)
            ->orderBy('cuenta', 'ASC')
            ->get();
            return response()->json(
                [
                    'lista' => $cuentasbancarias,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }

    public function cuentasdestino(Request $request){
        if(isset($request->texto)){
            $cuentasbancarias = Cuentasbancaria::where('banco_id', $request->texto)
            ->orderBy('cuenta', 'ASC')
            ->get();
            return response()->json(
                [
                    'lista' => $cuentasbancarias,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }

    public function pdf($id)
    {
       // $compromiso = Compromiso::find($id);
       // $pagado = Pagado::find($id);
       $transferenciaentrecuenta = Transferenciaentrecuenta::find($id);
       //Cambiar el total de numeros a letras
       $formatter = new NumeroALetras();
       $total_letras = $formatter->toMoney($transferenciaentrecuenta->monto, 2, 'BOLIVARES', 'CTS');

       $pdf = PDF::loadView('transferenciaentrecuenta.pdf', ['total_letras'=> $total_letras, 'transferenciaentrecuenta'=> $transferenciaentrecuenta]);
       $pdf->setPaper('letter', 'portrait');
       return $pdf->stream();

    }


    public function reportes()
     {
        
         $bancos = Banco::pluck('denominacion' , 'id');
 
         $cuentas = Cuentasbancaria::pluck('cuenta', 'id');

         $bancosdestino = Banco::pluck('denominacion' , 'id');
 
         $cuentasdestino = Cuentasbancaria::pluck('cuenta', 'id');
 
         $usuarios = User::pluck('name' , 'id'); 
 
         $fecha_actual = Carbon::now();
       
 
         return view('transferenciaentrecuenta.reportes', compact('bancosdestino','cuentasdestino','cuentas','bancos','fecha_actual','usuarios'));
 
             
     }
 
     public function reporte_pdf(Request $request)
     {   
         //Buscar por rif
         $rif = $request->rif;
         //Obtener Beneficiario
         $beneficiario_id = false;
         $nombre_beneficiario = '';
         $rs_beneficiario = Beneficiario::where('rif', $rif)->first();
         if($rs_beneficiario){
             $beneficiario_id = $rs_beneficiario->id;
             $nombre_beneficiario = $rs_beneficiario->nombre;
         }
 
         //Buscar por 
         $banco = $request->banco;
         $cuenta = $request->cuenta;

         $banco_dest = $request->banco_dest;
         $cuenta_dest = $request->cuenta_dest;
         
         $usuario = $request->usuario_id;
         $inicio = $request->fecha_inicio;
         $fin = $request->fecha_fin;
         
         $nombre_usuario = '';
         $rs_usuario = User::find($usuario);
         if($rs_usuario){
             $nombre_usuario = $rs_usuario->name;
         }
 
         $nombre_banco = '';
         $rs_banco= Banco::find($banco);
         if($rs_banco){
             $nombre_banco = $rs_banco->denominacion;
         }
 
         $nombre_cuenta = '';
         $rs_cuenta= Cuentasbancaria::find($cuenta);
         if($rs_cuenta){
             $nombre_cuenta = $rs_cuenta->cuenta;
         }

         $nombre_banco_dest = '';
         $rs_banco_dest= Banco::find($banco_dest);
         if($rs_banco_dest){
             $nombre_banco_dest = $rs_banco_dest->denominacion;
         }
 
         $nombre_cuenta_dest = '';
         $rs_cuenta_dest= Cuentasbancaria::find($cuenta_dest);
         if($rs_cuenta_dest){
             $nombre_cuenta_dest = $rs_cuenta_dest->cuenta;
         }
 
         //
         
         $transferenciaentrecuentas = Transferenciaentrecuenta::bancos($banco)->cuentas($cuenta)->bancosdest($banco_dest)->cuentasdest($cuenta_dest)->beneficiarios($beneficiario_id)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        
         
         $total_transferencias = $transferenciaentrecuentas->sum('monto');
         
 
         $datos = [
             'inicio' => $inicio,
             'fin' => $fin,  
             'usuario' =>$nombre_usuario,  
             'nombre_banco' => $nombre_banco,
             'nombre_cuenta' => $nombre_cuenta,
             'nombre_banco_dest' => $nombre_banco_dest,
             'nombre_cuenta_dest' => $nombre_cuenta_dest,
             'nombre_beneficiario' => $nombre_beneficiario,
             'total_transferencias' => $total_transferencias,
             ]; 
 
         $pdf = PDF::setPaper('letter', 'landscape')->loadView('transferenciaentrecuenta.reportepdf', ['datos'=>$datos, 'transferenciaentrecuentas'=>$transferenciaentrecuentas]);
         return $pdf->stream();
          
     }


}
