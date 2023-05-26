<?php

namespace App\Http\Controllers;

use App\Requisicione;
use App\Ejercicio;
use App\Institucione;
use App\Unidadadministrativa;
use App\Tipossgp;
use App\Detallesrequisicione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use PDF;

/**
 * Class RequisicioneController
 * @package App\Http\Controllers
 */
class RequisicioneController extends Controller
{

       /**
     * Metodo Constuct
     */
public function __construct()
{
    $this->middleware('can:admin.solicitudes')->only('index', 'edit', 'update', 'pdf', 'create', 'store', 'indexanuladas', 'indexprocesadas', 'indexaprobadas');
    
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
      if(Auth::user()->hasAnyRole('Admin')){    
        
        $requisiciones = Requisicione::query()
       ->when(request('search'), function($query){
           return $query->where ('correlativo', 'like', '%'.request('search').'%')
                             ->where('estatus', 'like', 'EP')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'EP')
                          ->orWhereHas('tipossgp', function($qa){
                            $qa->where('denominacion', 'like', '%'.request('search').'%');
                        })
                        ->where('estatus', 'like', 'EP');
        },
        function ($query) {
            $query->where('estatus', 'like', 'EP')
            ->orderBy('id', 'DESC');
        })
        
       ->paginate(25)
       ->withQueryString();

    }else{
        $requisiciones = Requisicione::query()
       ->when(request('search'), function($query){
           return $query->where ('correlativo', 'like', '%'.request('search').'%')
                             ->where('estatus', 'like', 'EP')
                             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'EP')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                          ->orWhereHas('tipossgp', function($qa){
                            $qa->where('denominacion', 'like', '%'.request('search').'%');
                        })
                        ->where('estatus', 'like', 'EP')
                        ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
        },
        function ($query) {
            $query->where('estatus', 'like', 'EP')
            ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

    }

        return view('requisicione.index', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());

            
    }

    /**
     * Display requisiciones procesadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
      
        if(Auth::user()->hasAnyRole('Admin')){    
        
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'PR')
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'PR')
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'PR');
            },
            function ($query) {
                $query->where('estatus', 'like', 'PR')
                ->orderBy('id', 'DESC');
            })
            
           ->paginate(25)
           ->withQueryString();
    
        }else{
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'PR')
                                 ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'PR')
                             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'PR')
                            ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
            },
            function ($query) {
                $query->where('estatus', 'like', 'PR')
                ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                ->orderBy('id', 'DESC');
            })
           ->paginate(25)
           ->withQueryString();
    
        }

        return view('requisicione.procesadas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
      
        if(Auth::user()->hasAnyRole('Admin')){    
        
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'AN')
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'AN')
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'AN');
            },
            function ($query) {
                $query->where('estatus', 'like', 'AN')
                ->orderBy('id', 'DESC');
            })
           ->paginate(25)
           ->withQueryString();
    
        }else{
           // $usuario = Auth::user()->unidad_id;
           // $unidad_administrativa = $usuario->unidad_id;
           
    
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'AN')
                                 ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'AN')
                             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'AN')
                            ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
            },
            function ($query) {
                $query->where('estatus', 'like', 'AN')
                ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                ->orderBy('id', 'DESC');
            })
           ->paginate(25)
           ->withQueryString();
    
        }

        return view('requisicione.anuladas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

    /**
     * Display requisiciones anuladas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
        // $requisiciones = Requisicione::where('estatus', 'AP')->paginate();
       /* $requisiciones = Requisicione::query()
        ->when(request('search'), function($query){
            return $query->where ('correlativo', 'like', '%'.request('search').'%')
                              ->where('estatus', 'like', 'AP')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                          ->where('estatus', 'like', 'AP')
                           ->orWhereHas('tipossgp', function($qa){
                             $qa->where('denominacion', 'like', '%'.request('search').'%');
                         })
                         ->where('estatus', 'like', 'AP');
         },
         function ($query) {
             $query->where('estatus', 'like', 'AP')
             ->orderBy('id', 'ASC');
         })
        ->paginate(25)
        ->withQueryString(); */
        if(Auth::user()->hasAnyRole('Admin')){    
        
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'AP')
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'AP')
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'AP');
            },
            function ($query) {
                $query->where('estatus', 'like', 'AP')
                ->orderBy('id', 'DESC');
            })
            
           ->paginate(25)
           ->withQueryString();
    
        }else{
           // $usuario = Auth::user()->unidad_id;
           // $unidad_administrativa = $usuario->unidad_id;
           
    
            $requisiciones = Requisicione::query()
           ->when(request('search'), function($query){
               return $query->where ('correlativo', 'like', '%'.request('search').'%')
                                 ->where('estatus', 'like', 'AP')
                                 ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                            ->orWhereHas('unidadadministrativa', function($q){
                             $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                             })
                             ->where('estatus', 'like', 'AP')
                             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                              ->orWhereHas('tipossgp', function($qa){
                                $qa->where('denominacion', 'like', '%'.request('search').'%');
                            })
                            ->where('estatus', 'like', 'AP')
                            ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
            },
            function ($query) {
                $query->where('estatus', 'like', 'AP')
                ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                ->orderBy('id', 'DESC');
            })
           ->paginate(25)
           ->withQueryString();
    
        }

        return view('requisicione.aprobadas', compact('requisiciones'))
            ->with('i', (request()->input('page', 1) - 1) * $requisiciones->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $requisicione = Requisicione::find($id);
        // $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        //Obtener las unidades de medidas de los productos, tenemos bos, producto, unidad medida
         $detallesrequisiciones = DB::table('detallesrequisiciones')
            ->where('requisicion_id', $id)
            ->join('bos', 'bos.id', '=', 'detallesrequisiciones.bos_id') 
            ->join('unidadmedidas', 'unidadmedidas.id', '=', 'bos.unidadmedida_id')
            ->select('detallesrequisiciones.cantidad', 'bos.descripcion', 'unidadmedidas.nombre')
            ->get(); 

        // Obtener las partidas que tienen que ver con esta requisicion a traves del bos y productos
        //declaro mi arrray partidas
        $partidas = DB::table('requidetclaspres')->where('requisicion_id', $id)->select('meta_id', 'claspres')->get();
            

        $pdf = PDF::loadView('requisicione.pdf', ['requisicione'=>$requisicione, 'detallesrequisiciones'=>$detallesrequisiciones, 'partidas'=>$partidas]);
        return $pdf->stream();
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requisicione = new Requisicione();

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        //$unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipossgps = Tipossgp::pluck('denominacion' , 'id');

        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

       return view('requisicione.create', compact('requisicione' , 'ejercicios' , 'instituciones' , 'unidadadministrativas', 'tipossgps'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requisicione::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        //Obtener ultimo numero de requisicion dependiendo si es compra, servicio o suministro
        $tipo_requisicion = $request->tiposgp_id;
        $unidad_administrativa = $request->unidadadministrativa_id;

        $max_correlativo = DB::table('requisiciones')->where('tiposgp_id', $tipo_requisicion)->where('unidadadministrativa_id', $unidad_administrativa)->max('correlativo');
        $numero_correlativo = $max_correlativo + 1;

       // $request->correlativo = $numero_correlativo //18;
         $request->merge(['correlativo'  => $numero_correlativo]);
         $request->merge(['estatus'  => 'EP']);


        $requisicione = Requisicione::create($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion creado exitosamente.' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisicione = Requisicione::find($id);

        return view('requisicione.show', compact('requisicione'));
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $requisicione = Requisicione::find($id);


        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['requisicion' => $id]);

        //Consulto los datos especificos para la requisicion seleccionada
        $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        return view('requisicione.agregar', compact('requisicione', 'detallesrequisiciones'))
        ->with('i', (request()->input('page', 1) - 1) * $detallesrequisiciones->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisicione = Requisicione::find($id);

        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
       // $unidadadministrativas = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipossgps = Tipossgp::pluck('denominacion' , 'id');

        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

       return view('requisicione.edit', compact('requisicione' , 'ejercicios' , 'instituciones' , 'unidadadministrativas', 'tipossgps'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requisicione $requisicione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisicione $requisicione)
    {
        request()->validate(Requisicione::$rules);

        $requisicione->update($request->all());

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requisicione = Requisicione::find($id)->delete();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicione eliminado exitosamente.');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $requisicione = Requisicione::find($id);
        $requisicione->estatus = 'AN';
        $requisicione->save();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion Anulada exitosamente.');
    }

    public function reversar($id)
    {
        $requisicione = Requisicione::find($id);
        $requisicione->estatus = 'EP';
        $requisicione->save();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion Reversada exitosamente.');
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $requisicione = Requisicione::find($id);

        //Validar que tenga agregado al menos un registro en detalles requisiciones en caso
        //contrario no aprobarlo

        $detalles_requisiciones = Detallesrequisicione::where('requisicion_id', $id)->exists();

        if($detalles_requisiciones == true) { 

        $requisicione->estatus = 'PR';
        $requisicione->save();

        return redirect()->route('requisiciones.index')
            ->with('success', 'Requisicion Aprobada exitosamente.');

        }else{

            return redirect()->route('requisiciones.index')
            ->with('success', 'Error al intentar, aprobar la requisicion, necesita primero agregar detalles BOS, he intentar nuevamente.');

        }



    }

    public function pdfdepurar($id)
    {
        $requisicione = Requisicione::find($id);
        // $detallesrequisiciones = Detallesrequisicione::where('requisicion_id','=',$id)->paginate();

        //Obtener las unidades de medidas de los productos, tenemos bos, producto, unidad medida
         $detallesrequisiciones = DB::table('detallesrequisiciones')
            ->where('requisicion_id', $id)
            ->join('bos', 'bos.id', '=', 'detallesrequisiciones.bos_id') 
            ->join('productoscps', 'productoscps.producto_id', '=', 'bos.producto_id') 
            ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.id', '=', 'productoscps.clasificadorp_id') 
            ->join('unidadmedidas', 'unidadmedidas.id', '=', 'bos.unidadmedida_id')
            ->select('detallesrequisiciones.cantidad', 'bos.descripcion', 'unidadmedidas.nombre', 'clasificadorpresupuestarios.cuenta' )
            ->get(); 

        // Obtener las partidas que tienen que ver con esta requisicion a traves del bos y productos
        //declaro mi arrray partidas
        $partidas = DB::table('requidetclaspres')->where('requisicion_id', $id)->select('meta_id', 'claspres')->get();
            

        $pdf = PDF::loadView('requisicione.pdfdepurar', ['requisicione'=>$requisicione, 'detallesrequisiciones'=>$detallesrequisiciones, 'partidas'=>$partidas]);
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

        $usuarios = User::pluck('name' , 'id'); 

        $fecha_actual = Carbon::now();
      

        return view('requisicione.reportes', compact('fecha_actual','usuarios','tipossgps','instituciones','unidades','ejercicios'));

            
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $institucion = $request->institucion_id;
        $unidadAdministrativa = $request->unidadadministrativa_id;
        $ejercicio = $request->ejercicio_id;
        $requisicion = $request->tiposgp_id;
        $nombre_tipo = '';
        if($requisicion == 1)
        {
            $nombre_tipo = 'COMPRAS';
        }elseif($requisicion == 2){
            $nombre_tipo = 'SERVICIOS';
        }elseif($requisicion == 3){
            $nombre_tipo = 'SUMINISTROS';
        }
        
        $estatus = $request->estatus;
        $nombre_estatus = '';
        if($estatus == 'EP')
        {
            $nombre_estatus = 'EN PROCESO';
        }elseif($estatus == 'AP'){
            $nombre_estatus = 'APROBADO';
        }elseif($estatus == 'PR'){
            $nombre_estatus = 'PROCESADO';
        }elseif($estatus == 'AN'){
            $nombre_estatus = 'ANULADO';
        }
        $usuario = $request->usuario_id;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }

        $nombre_unidad = '';
        $rs_unidad= Unidadadministrativa::find($unidadAdministrativa);
        if($rs_unidad){
            $nombre_unidad = $rs_unidad->unidadejecutora;
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
        
        $requisiciones = Requisicione::institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $aprobadas = Requisicione::where('estatus', 'AP')->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Requisicione::where('estatus', 'PR')->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Requisicione::where('estatus', 'EP')->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Requisicione::where('estatus', 'AN')->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = Requisicione::institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $compras = Requisicione::where('tiposgp_id', 1)->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $servicios = Requisicione::where('tiposgp_id', 2)->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $suministros = Requisicione::where('tiposgp_id', 3)->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->requisicion($requisicion)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();

        /**
         $requisiciones = Requisicione::where('id', '>', 0)->orWhere('institucion_id', $institucion)->get();
        $aprobadas = Requisicione::where('estatus', 'AP')->count();
        $procesadas = Requisicione::where('estatus', 'PR')->count();
        $enproceso = Requisicione::where('estatus', 'EP')->count();
        $anuladas = Requisicione::where('estatus', 'AN')->count();
        $total = Requisicione::where('id', '>', 0)->count();
        $compras = Requisicione::where('tiposgp_id', 1)->count();
        $servicios = Requisicione::where('tiposgp_id', 2)->count();
        $suministros = Requisicione::where('tiposgp_id', 3)->count();
         */


        $datos = [
           // 'institucion' => $request->institucion_id,
            'aprobadas' => $aprobadas,
            'procesadas' => $procesadas,
            'enproceso' => $enproceso,
            'anuladas' => $anuladas,
            'total' => $total, 
            'compras' => $compras,
            'servicios' => $servicios,
            'suministros' => $suministros,
            'inicio' => $inicio,
            'fin' => $fin,  
            'usuario' =>$nombre_usuario,  
            'estatus' =>$nombre_estatus,  
            'tipo' => $nombre_tipo,
            'unidad' => $nombre_unidad,
            'ejercicio' => $nombre_ejercicio,
            'institucion' => $nombre_institucion
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('requisicione.reportepdf', ['datos'=>$datos, 'requisiciones'=>$requisiciones]);
        return $pdf->stream();
         
    }


}
