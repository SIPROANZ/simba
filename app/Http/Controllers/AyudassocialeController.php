<?php

namespace App\Http\Controllers;

use App\Ayudassociale;
use App\Unidadadministrativa;
use App\Tipodecompromiso;
use App\Beneficiario;
use App\Detallesayuda;
use App\Ejecucione;
use App\Models\User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class AyudassocialeController
 * @package App\Http\Controllers
 */
class AyudassocialeController extends Controller
{

    public function __construct()
{
    $this->middleware('can:admin.ayudas')->only('index', 'edit', 'update', 'pdf', 'create', 'store', 'indexanuladas', 'indexprocesadas', 'indexaprobadas');
    
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ayudassociales = Ayudassociale::where('status', 'EP')->paginate();

        $ayudassociales = Ayudassociale::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'EP')
                         ->orWhereHas('beneficiario', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'EP');
         },
         function ($query) {
             $query->where('status', 'like', 'EP')
             ->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('ayudassociale.index', compact('ayudassociales'))
            ->with('i', (request()->input('page', 1) - 1) * $ayudassociales->perPage());
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprocesadas()
    {
       // $ayudassociales = Ayudassociale::where('status', 'PR')->orderBy('id','DESC')->paginate();

       $ayudassociales = Ayudassociale::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'PR')
                         ->orWhereHas('beneficiario', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'PR');
         },
         function ($query) {
             $query->where('status', 'like', 'PR')
             ->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('ayudassociale.procesadas', compact('ayudassociales'))
            ->with('i', (request()->input('page', 1) - 1) * $ayudassociales->perPage());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanuladas()
    {
        // $ayudassociales = Ayudassociale::where('status', 'AN')->paginate();

        $ayudassociales = Ayudassociale::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'AN')
                         ->orWhereHas('beneficiario', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'AN');
         },
         function ($query) {
             $query->where('status', 'like', 'AN')
             ->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('ayudassociale.anuladas', compact('ayudassociales'))
            ->with('i', (request()->input('page', 1) - 1) * $ayudassociales->perPage());
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexaprobadas()
    {
      //  $ayudassociales = Ayudassociale::where('status', 'AP')->orderBy('id','DESC')->paginate();

        $ayudassociales = Ayudassociale::query()
        ->when(request('search'), function($query){
            return $query->where ('documento', 'like', '%'.request('search').'%')
                              ->where('status', 'like', 'AP')
                         ->orWhereHas('beneficiario', function($q){
                          $q->where('nombre', 'like', '%'.request('search').'%');
                          })
                          ->where('status', 'like', 'AP');
         },
         function ($query) {
             $query->where('status', 'like', 'AP')
             ->orderBy('id', 'DESC');
         })
         
        ->paginate(25)
        ->withQueryString();

        return view('ayudassociale.aprobadas', compact('ayudassociales'))
            ->with('i', (request()->input('page', 1) - 1) * $ayudassociales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ayudassociale = new Ayudassociale();

       /// $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $tipodecompromisos = Tipodecompromiso::orderBy('nombre','ASC')->pluck('nombre', 'id');
        $beneficiarios = Beneficiario::orderBy('nombre','ASC')->pluck('nombre', 'id');

        $unidadesadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
                ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('ayudassociale.create', compact('ayudassociale', 'unidadesadministrativas', 'tipodecompromisos', 'beneficiarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ayudassociale::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $request->merge(['status'=>'EP']);

        $ayudassociale = Ayudassociale::create($request->all());

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudas Social Creada Satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ayudassociale = Ayudassociale::find($id);

        return view('ayudassociale.show', compact('ayudassociale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ayudassociale = Ayudassociale::find($id);

       // $unidadesadministrativas = Unidadadministrativa::pluck('denominacion', 'id');
        $tipodecompromisos = Tipodecompromiso::pluck('nombre', 'id');
        $beneficiarios = Beneficiario::pluck('nombre', 'id');

        $unidadesadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id');

        return view('ayudassociale.edit', compact('ayudassociale', 'unidadesadministrativas', 'tipodecompromisos', 'beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ayudassociale $ayudassociale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ayudassociale $ayudassociale)
    {
        request()->validate(Ayudassociale::$rules);

        $ayudassociale->update($request->all());

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudas Social Editada con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        //Antes de eliminar descontar el monto que se va a eliminar 

        $ayudassociale = Ayudassociale::find($id)->delete();

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayudas Social Eliminada');
    }

    /**
     * Display the specified resource agregar detalles a una requisicion.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agregar($id)
    {
        $ayudassociale = Ayudassociale::find($id);

        //Creare una variable de sesion para guardar el id de esta requisicion
        session(['ayudas' => $id]);

        $detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->paginate();

        return view('ayudassociale.agregar', compact('detallesayudas', 'ayudassociale'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesayudas->perPage());
    }

      //Metodo para aprobar un analisis de cotizacion
    /**
     * @param int $id   CAMBIAR EL ESTATUS A PROCESADO CUANDO YA ESTA aprobada la requisicion
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function aprobar($id)
    {
        $aprobado = 1;
        $procesar = 0; 
        $ayudassociale = Ayudassociale::find($id);
       
        

        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();

        if($detallesayudas->count()>0){ 
        //Ciclo para validar que todas las partidas tengan disponibilidad
        foreach($detallesayudas as $rows){
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
                $ayudassociale->status = 'EP';
                $ayudassociale->save();
            }
            //$cad_resulltados .= ' monto: ' . $monto . ' ejecucion: ' . $ejecucion_id . ' Disponible: ' . $disponible_ejecucion; 
        }

        //Si la bandera procesar aun permanece en 0 quiere decir que si hay disponibilidad y procedo
        //a precomprometer de la ejecucion los montos pasados
        if($procesar == 0){
            foreach($detallesayudas as $rows){
                $monto =  $rows->montocompromiso;
                $ejecucion_id = $rows->ejecucion_id;
                //Obtenemos el monto en la ejecucion 
                $ejecucion = Ejecucione::find($ejecucion_id);
                $ejecucion->increment('monto_precomprometido', $monto);
 
            }
        }
        
        if($aprobado == 1){

            $ayudassociale->status = 'PR';
            $ayudassociale->save();

            return redirect()->route('ayudassociales.index')
            ->with('success', 'Ayuda Social Precomprometida Exitosamente. ');
        }else{
            return redirect()->route('ayudassociales.index')
            ->with('success', 'No Aprobado. No hay Disponibilidad o ha ocurrido un error en el registro');
        }

     } else {
        return redirect()->route('ayudassociales.index')
        ->with('success', 'Error. No hay ninguna imputacion para esta ayuda');
    

     } /* fin de if */
    }

  
    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function modificar($id)
    {
        $ayudassociale = Ayudassociale::find($id);
       
        //Regresar la ejecucion que se imputo en la ejecucion
        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();
        //Ciclo para validar que todas las partidas tengan disponibilidad
        //Ciclo inverso a imputar en la ejecucion
        foreach($detallesayudas as $rows){
            $monto =  $rows->montocompromiso;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $ejecucion->decrement('monto_precomprometido', $monto);

        }

        $ayudassociale->status = 'EP';
        $ayudassociale->save();

        return redirect()->route('ayudassociales.index')
            ->with('success', 'Compromiso Ya se Puede Modificar exitosamente.');
         
    }

    /**
     * @param int $id   CAMBIAR EL ESTATUS A ANULADO A UNA REQUISICION
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function anular($id)
    {
        $ayudassociale = Ayudassociale::find($id);
       
        if($ayudassociale->status = 'PR' || $ayudassociale->status = 'AP'){ 
        //Regresar la ejecucion que se imputo en la ejecucion
        //Obtener el detalle ejecucion y corroborar que haya disponibilidad
        $detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();
        //Ciclo para validar que todas las partidas tengan disponibilidad
        //Ciclo inverso a imputar en la ejecucion
        foreach($detallesayudas as $rows){
            $monto =  $rows->montocompromiso;
            $ejecucion_id = $rows->ejecucion_id;
            //Obtenemos el monto en la ejecucion 
            $ejecucion = Ejecucione::find($ejecucion_id);
            $ejecucion->decrement('monto_precomprometido', $monto);

        }

        $ayudassociale->status = 'AN';
        $ayudassociale->save();

        }

        $fecha = Carbon::now();
        $ayudassociale->fechaanulacion = $fecha;
        $ayudassociale->status = 'AN';
        $ayudassociale->save();


        return redirect()->route('ayudassociales.index')
            ->with('success', 'Compromiso Anulado exitosamente.');
         
    }

    /**
     * Crear pdf de la requisicion seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $ayudassociale = Ayudassociale::find($id);


        $detallesayudas = Detallesayuda::where('ayuda_id','=',$id)->get();
        
        $totalcompromiso = $detallesayudas->sum('montocompromiso');

        $status=null;
        
        if( $ayudassociale->status=='AP'){
            $status='Aprobado';
        }
        elseif( $ayudassociale->status=='PR'){
            $status='Procesado';    
        }
        elseif( $ayudassociale->status=='EP'){
            $status='En proceso';    
        }
        elseif( $ayudassociale->status=='AN'){
            $status='Anulado';    
        }
        elseif( $ayudassociale->status=='RV '){
            $status='Reservado';    
        }

        $pdf = PDF::loadView('ayudassociale.pdf', ['ayudassociale'=>$ayudassociale, 'detallesayudas'=>$detallesayudas, 'status'=> $status, 'totalcompromiso'=>$totalcompromiso]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream();

    }

    public function reportes()
    {
       
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
       

        $usuarios = User::orderBy('name', 'ASC')->pluck('name' , 'id'); 

        $fecha_actual = Carbon::now();
      

        return view('ayudassociale.reportes', compact('fecha_actual','usuarios','unidades'));

            
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

        


        //
        
        $ayudas = Ayudassociale::beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_bs = $ayudas->sum('montototal');
        $aprobadas = Ayudassociale::where('status', 'AP')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $procesadas = Ayudassociale::where('status', 'PR')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $enproceso = Ayudassociale::where('status', 'EP')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $anuladas = Ayudassociale::where('status', 'AN')->beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
        $total = Ayudassociale::beneficiarios($beneficiario_id)->unidad($unidadAdministrativa)->estatus($estatus)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->count();
       
     


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

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('ayudassociale.reportepdf', ['datos'=>$datos, 'ayudas'=>$ayudas]);
        return $pdf->stream();
        
         
    }

}
