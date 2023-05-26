<?php

namespace App\Http\Controllers;

use App\Notasdecredito;
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
 * Class NotasdecreditoController
 * @package App\Http\Controllers
 */
class NotasdecreditoController extends Controller
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
      //  $notasdecreditos = Notasdecredito::paginate();

        $notasdecreditos = Notasdecredito::query()
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

        return view('notasdecredito.index', compact('notasdecreditos'))
            ->with('i', (request()->input('page', 1) - 1) * $notasdecreditos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notasdecredito = new Notasdecredito();
        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();


        return view('notasdecredito.create', compact('bancos', 'notasdecredito', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Notasdecredito::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        //Verificar que el numero de referencia y el bando no se repita
        $validar = Notasdecredito::where('cuentabancaria_id', $request->cuentabancaria_id)->where('referencia', $request->referencia)->exists();

        if($validar!= true){ $notasdecredito = Notasdecredito::create($request->all());
            //Obtener el id de la cuenta bancaria porque se le debe sumar el monto acreditado
            $cuentabancaria_id = $request->cuentabancaria_id;
    
            $cuentabanco = Cuentasbancaria::find($cuentabancaria_id);
            $cuentabanco->increment('montosaldo', $request->monto);
    
            
    
            return redirect()->route('notasdecreditos.index')
                ->with('success', 'Nota de credito creada satisfactoriamente.'); 
                }
                else
                {
                    return redirect()->route('notasdecreditos.index')
                ->with('success', 'Error: Numero de referencia esta repetida.'); 
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
        $notasdecredito = Notasdecredito::find($id);

        return view('notasdecredito.show', compact('notasdecredito'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notasdecredito = Notasdecredito::find($id);
        $ejercicios = Ejercicio::orderBy('id','DESC')->pluck('ejercicioejecucion', 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $bancos = Banco::all();

        return view('notasdecredito.edit', compact('notasdecredito', 'bancos', 'ejercicios', 'instituciones', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notasdecredito $notasdecredito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notasdecredito $notasdecredito)
    {
        request()->validate(Notasdecredito::$rules);

        //Obtengo el valor viejo el cual tengo  que decrementar y luego el valor nuevo lo ingreso
        $montoviejo = $notasdecredito->monto;
        $montonuevo = $request->monto;

        //Obtener el banco al cual quiero actualizar el valor
        $cuentabancaria = Cuentasbancaria::find($notasdecredito->cuentabancaria_id);
        $cuentabancaria->decrement('montosaldo', $montoviejo);
        $cuentabancaria->increment('montosaldo', $montonuevo);

        $notasdecredito->update($request->all());

        return redirect()->route('notasdecreditos.index')
            ->with('success', 'Nota de credito editada satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notasdecredito = Notasdecredito::find($id);

        $cuenta = Cuentasbancaria::find($notasdecredito->cuentabancaria_id);
        $cuenta->decrement('montosaldo', $notasdecredito->monto);
        
        $notasdecredito->delete();

        return redirect()->route('notasdecreditos.index')
            ->with('success', 'Nota de credito eliminada satisfactoriamente');
    }

    //para llenar un select dinamico
    public function cuentas(Request $request){
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
       $notasdecredito = Notasdecredito::find($id);
       $total_transferencia = $notasdecredito->monto;
       //Cambiar el total de numeros a letras
       $formatter = new NumeroALetras();
       $total_letras = $formatter->toMoney($total_transferencia , 2, 'BOLIVARES', 'CTS');

       $pdf = PDF::loadView('notasdecredito.pdf', ['total_letras'=> $total_letras, 'notasdecredito'=> $notasdecredito]);
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
      

        return view('notasdecredito.reportes', compact('cuentas','bancos','fecha_actual','usuarios','tipossgps','instituciones','unidades','ejercicios'));

            
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
        
        $notasdecreditos = Notasdecredito::institucion($institucion)->ejercicio($ejercicio)->bancos($banco)->cuentas($cuenta)->beneficiarios($beneficiario_id)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_creditos = $notasdecreditos->sum('monto');

        $datos = [
           
            'inicio' => $inicio,
            'fin' => $fin,  
            'usuario' =>$nombre_usuario,  
            'ejercicio' => $nombre_ejercicio,
            'institucion' => $nombre_institucion,
            'nombre_banco' => $nombre_banco,
            'nombre_cuenta' => $nombre_cuenta,
            'nombre_beneficiario' => $nombre_beneficiario,
            'total_creditos' => $total_creditos
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('notasdecredito.reportepdf', ['datos'=>$datos, 'notasdecreditos'=>$notasdecreditos]);
        return $pdf->stream();
         
    }

}
