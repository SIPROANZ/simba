<?php

namespace App\Http\Controllers;

use App\Notasdedebito;
use App\Ejercicio;
use App\Beneficiario;
use App\Institucione;
use App\Banco;
use App\Cuentasbancaria;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

use App\Unidadadministrativa;
use App\Tipossgp;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * Class NotasdedebitoController
 * @package App\Http\Controllers
 */
class NotasdedebitoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.pagados')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $notasdedebitos = Notasdedebito::paginate();

        $notasdedebitos = Notasdedebito::query()
       ->when(request('search'), function($query){
           return $query->where ('referencia', 'like', '%'.request('search').'%')
                        ->orWhere('descripcion', 'like', '%'.request('search').'%')
                        ->orWhereHas('banco', function($q){
                         $q->where('denominacion', 'like', '%'.request('search').'%');
                         })
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        });
        },
        function ($query) {
            $query->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

        return view('notasdedebito.index', compact('notasdedebitos'))
            ->with('i', (request()->input('page', 1) - 1) * $notasdedebitos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notasdedebito = new Notasdedebito();

        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();


        return view('notasdedebito.create', compact('notasdedebito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notasdedebito::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        
        //Verificar que el numero de referencia y el bando no se repita
        $validar = Notasdedebito::where('cuentabancaria_id', $request->cuentabancaria_id)->where('referencia', $request->referencia)->exists();

        if($validar!= true){ 

        $cuenta = Cuentasbancaria::find($request->cuentabancaria_id);
        $montosaldo = $cuenta->montosaldo;

        if($request->monto>$montosaldo) {
            return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: El monto a debitar es mayor al saldo de la cuenta bancaria.');
        }else{
           

            $notasdedebito = Notasdedebito::create($request->all());
            $cuenta->decrement('montosaldo', $request->monto);


        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito creada satisfactoriamente.');

        }

    }else {
        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: El numero de referencia y cuenta bancaria se repite en el sistemna.');

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
        $notasdedebito = Notasdedebito::find($id);

        return view('notasdedebito.show', compact('notasdedebito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notasdedebito = Notasdedebito::find($id);

        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();

        return view('notasdedebito.edit', compact('notasdedebito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notasdedebito $notasdedebito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasdedebito $notasdedebito)
    {
        request()->validate(Notasdedebito::$rules);


        //Codigo para editar
         //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
         $cuentabancaria = Cuentasbancaria::find($notasdedebito->cuentabancaria_id);
         $montoviejo = $notasdedebito->monto;
         $montonuevo = $request->monto;
 
         if($montonuevo>($montoviejo + $cuentabancaria->montosaldo) ) {
            return redirect()->route('notasdedebitos.index')
            ->with('success', 'Error: No se ha podido actualizar, porque el nuevo monto es mayor al saldo de la cuenta bancaria');
        }else{
           //Obtener el banco al cual quiero actualizar el valor
         $cuentabancaria->increment('montosaldo', $montoviejo);
         $cuentabancaria->decrement('montosaldo', $montonuevo);

        $notasdedebito->update($request->all());

        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito actualizada satisfactoriamente');

        }


    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notasdedebito = Notasdedebito::find($id);
        
        $cuentabancaria = Cuentasbancaria::find($notasdedebito->cuentabancaria_id);
        $cuentabancaria->increment('montosaldo', $notasdedebito->monto);
       
        $notasdedebito->delete();

        return redirect()->route('notasdedebitos.index')
            ->with('success', 'Nota de debito eliminada satisfactoriamente');
    }

    //para llenar un select dinamico
    public function cuentasdeb(Request $request){
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
       $notasdedebito = Notasdedebito::find($id);
       $total_transferencia = $notasdedebito->monto;
       //Cambiar el total de numeros a letras
       $formatter = new NumeroALetras();
       $total_letras = $formatter->toMoney($total_transferencia , 2, 'BOLIVARES', 'CTS');

       $pdf = PDF::loadView('notasdedebito.pdf', ['total_letras'=> $total_letras, 'notasdedebito'=> $notasdedebito]);
       $pdf->setPaper('letter', 'portrait');
       return $pdf->stream();

    }

    public function reportes()
    {
       
        $ejercicios = Ejercicio::pluck('nombreejercicio','id');
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
        $instituciones = Institucione::pluck('institucion', 'id');

        $tipossgps = Tipossgp::pluck('denominacion' , 'id'); 

        $bancos = Banco::pluck('denominacion' , 'id');

        $cuentas = Cuentasbancaria::pluck('cuenta', 'id');

        $usuarios = User::pluck('name' , 'id'); 

        $fecha_actual = Carbon::now();
      

        return view('notasdedebito.reportes', compact('cuentas','bancos','fecha_actual','usuarios','tipossgps','instituciones','unidades','ejercicios'));

            
    }

    public function reporte_pdf(Request $request)
    {   
        //Buscar por institucion
        $rif = $request->rif;
        //Obtener Beneficiario
        $beneficiario_id = false;
        $nombre_beneficiario = '';
        $rs_beneficiario = Beneficiario::where('rif', $rif)->first();
        if($rs_beneficiario){
            $beneficiario_id = $rs_beneficiario->id;
            $nombre_beneficiario = $rs_beneficiario->nombre;
        }

        //Buscar por institucion
        $institucion = $request->institucion_id;
        $banco = $request->banco;
        $cuenta = $request->cuenta;
        $ejercicio = $request->ejercicio_id;
        
        
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

        $nombre_ejercicio = '';
        $rs_ejercicio = Ejercicio::find($ejercicio);
        if($rs_ejercicio){
            $nombre_ejercicio = $rs_ejercicio->ejercicioejecucion;
        }

        $nombre_institucion = '';
        $rs_institucion = Institucione::find($institucion);
        if($rs_institucion){
            $nombre_institucion = $rs_institucion->institucion;
        }


        //
        
        $notasdedebitos = Notasdedebito::institucion($institucion)->ejercicio($ejercicio)->bancos($banco)->cuentas($cuenta)->beneficiarios($beneficiario_id)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_debitos = $notasdedebitos->sum('monto');

        $datos = [
           
            'inicio' => $inicio,
            'fin' => $fin,  
            'usuario' =>$nombre_usuario,  
            'ejercicio' => $nombre_ejercicio,
            'institucion' => $nombre_institucion,
            'nombre_banco' => $nombre_banco,
            'nombre_cuenta' => $nombre_cuenta,
            'nombre_beneficiario' => $nombre_beneficiario,
            'total_debitos' => $total_debitos
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('notasdedebito.reportepdf', ['datos'=>$datos, 'notasdedebitos'=>$notasdedebitos]);
        return $pdf->stream();
         
    }

    
}
