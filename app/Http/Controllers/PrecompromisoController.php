<?php

namespace App\Http\Controllers;

use App\Precompromiso;
use App\Unidadadministrativa;
use App\Tipodecompromiso;
use App\Beneficiario;
use App\Detallesprecompromiso;
use App\Clasificadorpresupuestario;
use App\Ejecucione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;


use App\Models\User;

/**
 * Class PrecompromisoController
 * @package App\Http\Controllers
 */
class PrecompromisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.precompromisos')->only('index', 'edit', 'update', 'pdf', 'create', 'store', 'indexanuladas', 'indexprocesadas', 'indexaprobadas');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $precompromisos = Precompromiso::where('status', 'EP')->paginate();
       if(Auth::user()->hasAnyRole('Admin')){  
       $precompromisos = Precompromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'EP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'EP');
        },
        function ($query) {
            $query->where('status', 'like', 'EP')
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();
    }else{
        $precompromisos = Precompromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'EP')
                        ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'EP')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'EP')
                        ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
        },
        function ($query) {
            $query->where('status', 'like', 'EP')
            ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();

    }

     /*   $precompromisos = Precompromiso::query()
                        ->when(request('search'), function($query){
                            return $query->where ('id', 'like', '%'.request('search').'%')
                                           ->where('status', 'like', 'EP');
                                           
                            //aqui se puede colocar otro orWhere para otra consulta a la misma tabla pero en otro campo
                            //->orWhere ('monto_inicial', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('unidadadministrativa', function($q){
                            $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->paginate(25)
                        ->withQueryString();
                       */
                        /*

                        $precompromisos = Precompromiso::query()
                        ->when(request('search'), function($query){
                            return $query->where ('id', 'like', '%'.request('search').'%')
                                           ->where('status', 'EP');
                            //aqui se puede colocar otro orWhere para otra consulta a la misma tabla pero en otro campo
                            //->orWhere ('monto_inicial', 'like', '%'.request('search').'%');
                        })
                        ->paginate()
                        ->withQueryString(); */


        return view('precompromiso.index', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
       // $precompromisos = Precompromiso::where('status', 'PR')->paginate();

       /* $precompromisos = Precompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                           ->where('status', 'like', 'PR');
            //aqui se puede colocar otro orWhere para otra consulta a la misma tabla pero en otro campo
            //->orWhere ('monto_inicial', 'like', '%'.request('search').'%');
        })
        ->orWhereHas('unidadadministrativa', function($q){
            $q->where('unidadejecutora', 'like', '%'.request('search').'%');
        })
        ->orWhereHas('beneficiario', function($qa){
            $qa->where('nombre', 'like', '%'.request('search').'%');
        })
        ->paginate()
        ->withQueryString(); */
        if(Auth::user()->hasAnyRole('Admin')){  
        $precompromisos = Precompromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'PR')
                        ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'PR')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })->where('status', 'like', 'PR')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'PR');
        },
        function ($query) {
            $query->where('status', 'like', 'PR')
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();
    }else{
        $precompromisos = Precompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                         ->where('status', 'like', 'PR')
                         ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'PR')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })->where('status', 'like', 'PR')
                          ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'PR')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
         },
         function ($query) {
             $query->where('status', 'like', 'PR')
             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();
    }


        return view('precompromiso.procesadas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
       // $precompromisos = Precompromiso::where('status', 'AN')->paginate();

       if(Auth::user()->hasAnyRole('Admin')){  
       $precompromisos = Precompromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                             ->where('status', 'like', 'AN')
                             ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AN')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'AN')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'AN');
        },
        function ($query) {
            $query->where('status', 'like', 'AN')
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();
    }else{
        $precompromisos = Precompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                         ->where('status', 'like', 'AN')
                         ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AN')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })->where('status', 'like', 'AN')
                          ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'AN')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
         },
         function ($query) {
             $query->where('status', 'like', 'AN')
             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();
    }

        return view('precompromiso.anuladas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
       // $precompromisos = Precompromiso::where('status', 'AP')->paginate();

       if(Auth::user()->hasAnyRole('Admin')){  
       $precompromisos = Precompromiso::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                             ->where('status', 'like', 'AP')
                             ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AP')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'AP')
                          ->orWhereHas('beneficiario', function($qa){
                            $qa->where('nombre', 'like', '%'.request('search').'%');
                        })
                        ->where('status', 'like', 'AP');
        },
        function ($query) {
            $query->where('status', 'like', 'AP')
            ->orderBy('id', 'DESC');
        })
       ->paginate(25)
       ->withQueryString();
    }else{
        $precompromisos = Precompromiso::query()
        ->when(request('search'), function($query){
            return $query->where ('id', 'like', '%'.request('search').'%')
                         ->where('status', 'like', 'AP')
                         ->orWhere('documento', 'like', '%'.request('search').'%')
                        ->where('status', 'like', 'AP')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })->where('status', 'like', 'AP')
                          ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
                           ->orWhereHas('beneficiario', function($qa){
                             $qa->where('nombre', 'like', '%'.request('search').'%');
                         })
                         ->where('status', 'like', 'AP')
                         ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id);
         },
         function ($query) {
             $query->where('status', 'like', 'AP')
             ->where('unidadadministrativa_id', 'like', Auth::user()->unidad_id)
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();
    }

        return view('precompromiso.aprobadas', compact('precompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $precompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precompromiso = new Precompromiso();
       // $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');

       $unidades = Unidadadministrativa::select(
        DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
        ->pluck('name', 'id');


        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.create', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Precompromiso::$rules);

        $request->merge(['status'  => 'EP']);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        //Validar que el numero de documento no se repita
        $validardocumento = Precompromiso::where('documento', $request->documento)->first();

        if($validardocumento != NULL)
        {
        return redirect()->route('precompromisos.index')
            ->with('success', 'Alerta. El Valor del Documento ingresado esta repetido en el sistema.');
        }else{
            $precompromiso = Precompromiso::create($request->all());

            return redirect()->route('precompromisos.index')
                ->with('success', 'Precompromiso registrado con exito.');
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
        $precompromiso = Precompromiso::find($id);
        $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        return view('precompromiso.show', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $precompromiso = Precompromiso::find($id);
       // $unidades = Unidadadministrativa::pluck('unidadejecutora', 'id');
        $tipocompromisos = Tipodecompromiso::pluck('nombre','id');
        $beneficiarios = Beneficiario::pluck('nombre','id');

        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->pluck('name', 'id');

        return view('precompromiso.edit', compact('precompromiso', 'unidades', 'tipocompromisos', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Precompromiso $precompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Precompromiso $precompromiso)
    {
        request()->validate(Precompromiso::$rules);

        $precompromiso->update($request->all());

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $precompromiso = Precompromiso::find($id)->delete();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso deleted successfully');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $precompromiso = Precompromiso::find($id);

        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['precompromisos' => $id]);

        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)
        ->orderBy('ejecucion_id', 'ASC')->paginate(); 

      /*  $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)
       ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesprecompromisos.ejecucion_id') 
       ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=', 'ejecuciones.clasificadorpresupuestario')
       ->select('detallesprecompromisos.id', 'detallesprecompromisos.montocompromiso', 'detallesprecompromisos.precompromiso', 'detallesprecompromisos.unidadadministrativa', 'detallesprecompromisos.ejecucione')
       ->orderBy('clasificadorpresupuestarios.cuenta','ASC')
       ->paginate(); */

        return view('precompromiso.agregar', compact('detallesprecompromisos', 'precompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesprecompromisos->perPage());
    }

     /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $precompromiso = Precompromiso::find($id);

       // $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->paginate();
       // $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->orderBy('ejecucion_id', 'ASC')->get();

      /* $detallesprecompromisos = DB::table('detallesprecompromisos')
       ->where('precompromiso_id', $id)
       ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesprecompromisos.ejecucion_id') 
       ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=', 'ejecuciones.clasificadorpresupuestario')
       ->orderBy('clasificadorpresupuestarios.cuenta','ASC')
       ->get(); */

       $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)
       ->join('ejecuciones', 'ejecuciones.id', '=', 'detallesprecompromisos.ejecucion_id') 
       ->join('clasificadorpresupuestarios', 'clasificadorpresupuestarios.cuenta', '=', 'ejecuciones.clasificadorpresupuestario')
       ->orderBy('clasificadorpresupuestarios.cuenta','ASC')
       ->get();


        $totalcompromiso = $detallesprecompromisos->sum('montocompromiso');

        $datos = array();

        
        $status=null;
        
        if($precompromiso->status=='AP'){
            $status='Aprobado';
        }
        elseif($precompromiso->status=='PR'){
            $status='Procesado';    
        }
        elseif($precompromiso->status=='EP'){
            $status='En proceso';    
        }
        elseif($precompromiso->status=='AN'){
            $status='Anulado';    
        }
        elseif($precompromiso->status=='RV '){
            $status='Reservado';    
        }


        foreach($detallesprecompromisos as $rows){
            //Obtener la denominacion a partir de la cuenta
            $ejecucion = Ejecucione::find($rows->ejecucion_id);
            $cuenta = Clasificadorpresupuestario::where('cuenta', $ejecucion->clasificadorpresupuestario)->first();
            $datos = Arr::add($datos, $rows->ejecucion_id, $cuenta->denominacion);

        }


        $pdf = PDF::loadView('precompromiso.pdf', ['datos'=>$datos,'precompromiso'=>$precompromiso, 'detallesprecompromisos'=>$detallesprecompromisos, 'status'=> $status, 'totalcompromiso'=>$totalcompromiso]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('precompromiso.pdf');


      //  $pdf = PDF::loadView('pdf_view',  ['precompromiso'=>$precompromiso, 'detallesprecompromisos'=>$detallesprecompromisos, 'status'=> $status, 'totalcompromiso'=>$totalcompromiso]);
      // download PDF file with download method
      //  return $pdf->download('pdf_file.pdf');

    }


     /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $precompromiso = Precompromiso::find($id);
        $fecha = Carbon::now();

        
        if($precompromiso->status == 'AN')
        {
            return redirect()->route('precompromisos.index')
            ->with('success', 'El Precompromiso que esta intentando anular, ya usted lo ha anulado previamente, de un solo click en el boton anular. ');

        } else { 
        $precompromiso->fechaanulacion = $fecha;
        $precompromiso->status = 'AN';
        $precompromiso->save();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Anulado exitosamente.');

        }
     
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        $precompromiso = Precompromiso::find($id);

        if($precompromiso->status == 'EP')
        {
            return redirect()->route('precompromisos.index')
            ->with('success', 'El Precompromiso que esta intentando modificar, ya usted lo ha modificado previamente, de un solo click en el boton modificar. ');

        } else { 
        
       
        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->get();

        foreach($detallesprecompromisos as $rows){
            $monto =  $rows->montocompromiso;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $ejecucion->decrement('monto_precomprometido', $monto);

        }

        $precompromiso->status = 'EP';
        $precompromiso->save();

        return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Modificado exitosamente, esta nuevamente en proceso.');
    }
     
    }

     /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;
        $procesar = 0; 
        $precompromiso = Precompromiso::find($id);

        if($precompromiso->status == 'AP')
        {
            return redirect()->route('precompromisos.index')
            ->with('success', 'El Precompromiso que esta intentando aprobar, ya usted lo ha aprobado previamente, de un solo click en el boton aprobar. ');

        } else { 

        $montoprecompromiso = $precompromiso->montototal;
        

        $cadena_error ='';
        

        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        //$detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();
        $detallesprecompromisos = Detallesprecompromiso::where('precompromiso_id', $id)->get();
        $montodetalles = $detallesprecompromisos->sum('montocompromiso');


         //Validar
       if(bccomp($montodetalles, $montoprecompromiso, 2)==0)
        { 


        //Ciclo para validar que todas las partidas tengan disponibilidad
        foreach($detallesprecompromisos as $rows){
            $monto =  $rows->montocompromiso;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $monto_por_comprometer = $ejecucion->monto_por_comprometer;
            $monto_precomprometido = $ejecucion->monto_precomprometido;
            $disponible_ejecucion = $monto_por_comprometer - $monto_precomprometido;
            //Valido que tenga disponibilidad
            if($monto > $disponible_ejecucion)
            {
                $procesar = 1; //Hubo falta de disponibilidad en alguna ejecucion
                $aprobado = 0;
                $precompromiso->status = 'EP';
                $precompromiso->save();
                $cadena_error .= ' monto a precomprometer: ' . $monto . ' Disponible: ' . $disponible_ejecucion . ' Clasificador: ' . $ejecucion->clasificadorpresupuestario;
            }
            //$cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id . ' Disponible: ' . $disponible_ejecucion; 
        }

        //Si la bandera procesar aun permanece en 0 quiere decir que si hay disponibilidad y procedo
        //a precomprometer de la ejecucion los montos pasados
        if($procesar == 0){
            foreach($detallesprecompromisos as $rows){
                $monto =  $rows->montocompromiso;
                $ejecucion_id = $rows->ejecucion_id;
                //Obtenemos el monto en la ejecucion 
                $ejecucion = Ejecucione::find($ejecucion_id);
                $ejecucion->increment('monto_precomprometido', $monto);
 
            }

            $precompromiso->status = 'PR';
            $precompromiso->save();
        }
        

       

        if($aprobado == 1){
            return redirect()->route('precompromisos.index')
            ->with('success', 'Precompromiso Aprobado Exitosamente.'); 
            // return redirect()->route('precompromisos.index')->with('aprobar','ok'); 
        }else{
            return redirect()->route('precompromisos.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro. ' . $cadena_error);
        }

    } else {
        return redirect()->route('precompromisos.index')
        ->with('success', 'Error: Hay una diferencia entre la sumatoria del detalle y el monto que va a precomprometer. Monto a precomprometer: ' . $montoprecompromiso . ' Sumatoria detalles: ' . $montodetalles ); 
    }

}

    }


    public function reportes()
    {
       
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
    

        $usuarios = User::orderBy('name', 'ASC')->pluck('name' , 'id'); 

        $fecha_actual = Carbon::now();
      

        return view('precompromiso.reportes', compact('fecha_actual','usuarios','unidades'));

            
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
        
        $unidadAdministrativa = $request->unidadadministrativa_id;
        
        $estatus = $request->status;
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
        
        $precompromisos = Precompromiso::beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_bs = $precompromisos->sum('montototal');
        $aprobadas = Precompromiso::where('status', 'AP')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Precompromiso::where('status', 'PR')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Precompromiso::where('status', 'EP')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Precompromiso::where('status', 'AN')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = Precompromiso::beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
       
     


        $datos = [
            
            'aprobadas' => $aprobadas,
            'procesadas' => $procesadas,
            'enproceso' => $enproceso,
            'anuladas' => $anuladas,
            'total' => $total, 
            
            
            'inicio' => $inicio,
            'fin' => $fin,  
            'usuario' =>$nombre_usuario,  
            'estatus' =>$nombre_estatus,  
            'unidad' => $nombre_unidad,
            'beneficiario' => $nombre_beneficiario,
            'total_bs' => $total_bs
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('precompromiso.reportepdf', ['datos'=>$datos, 'precompromisos'=>$precompromisos]);
        return $pdf->stream();
        
         
    }



}
