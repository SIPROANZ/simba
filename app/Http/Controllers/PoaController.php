<?php

namespace App\Http\Controllers;

use App\Poa;
use App\Ejercicio;
use App\Institucione;
use App\Objetivoshistorico;
use App\Objetivonacionale;
use App\Objetivosestrategico;
use App\Objetivogenerale;
use App\Objetivomunicipale;
use App\Objetivopei;
use App\Configuracione;
use App\Models\User;
use App\Unidadadministrativa;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PDF;



/**
 * Class PoaController
 * @package App\Http\Controllers
 */
class PoaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.poa')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // LAS BUSQUEDAS ESTAN SOLAMENTE PARA EL ID POA EJERCIO, TANTO LA PRIMERA BUSQUEDA,
       // CASO QUE NO HAGA EL WHEN, O PARA CUANDO BUSCA POR PROYECTO, EN LOS OTROS CASO
       // POR UNIDAD ADMINISTRATIVA O POR USUARIO.
       // $poas = Poa::paginate();
       
       //Obtener el id del ejercio para el POA que quiero mostrar
       $rs_poa = Configuracione::where('nombre', 'poa_ejercicio')->first();
       $poa_id = 1;
       if($rs_poa){
        $poa_id = $rs_poa->valor;
       }

        $poas = Poa::query()
        ->when(request('search'), function($query) use ($poa_id) {
            return $query->where('ejercicio_id', $poa_id)
                        ->where ('proyecto', 'like', '%'.request('search').'%')
                         //->orWhere('objetivoproyecto', 'like', '%'.request('search').'%')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                           ->orWhereHas('usuario', function($qa){
                             $qa->where('name', 'like', '%'.request('search').'%');
                         });
         },
         function ($query) use ($poa_id) {
             $query->where('id', '>', 0)
             ->where('ejercicio_id', $poa_id)
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('poa.index', compact('poas'))
            ->with('i', (request()->input('page', 1) - 1) * $poas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $poa = new Poa();
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $objetivoshistoricos= Objetivoshistorico::pluck('objetivo', 'id');
        $objetivonacionales= Objetivonacionale::pluck('objetivo', 'id');
        $objetivosestrategicos= Objetivosestrategico::pluck('objetivo', 'id');
        $objetivogenerales= Objetivogenerale::pluck('objetivo', 'id');
        $objetivomunicipales= Objetivomunicipale::pluck('objetivo', 'id');
        $objetivopeis= Objetivopei::pluck('objetivo', 'id');
        //$unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->pluck('name', 'id');

        return view('poa.create', compact('poa', 'ejercicios', 'instituciones', 'objetivoshistoricos', 'objetivonacionales', 'objetivosestrategicos', 'objetivogenerales', 'objetivomunicipales','objetivopeis', 'unidadadministrativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Poa::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $poa = Poa::create($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poa = Poa::find($id);

        return view('poa.show', compact('poa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poa = Poa::find($id);
       
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        $objetivoshistoricos= Objetivoshistorico::pluck('objetivo', 'id');
        $objetivonacionales= Objetivonacionale::pluck('objetivo', 'id');
        $objetivosestrategicos= Objetivosestrategico::pluck('objetivo', 'id');
        $objetivogenerales= Objetivogenerale::pluck('objetivo', 'id');
        $objetivomunicipales= Objetivomunicipale::pluck('objetivo', 'id');
        $objetivopeis= Objetivopei::pluck('objetivo', 'id');
       // $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->pluck('name', 'id');

        return view('poa.edit', compact('poa', 'ejercicios', 'instituciones', 'objetivoshistoricos', 'objetivonacionales', 'objetivosestrategicos', 'objetivogenerales', 'objetivomunicipales','objetivopeis', 'unidadadministrativas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Poa $poa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poa $poa)
    {
        request()->validate(Poa::$rules);

        $poa->update($request->all());

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $poa = Poa::find($id)->delete();

        return redirect()->route('poas.index')
            ->with('success', 'Plan operativo anual eliminado exitosamente.');
    }

    public function reportes()
    {
       $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
       

        $usuarios = User::orderBy('name', 'ASC')->pluck('name' , 'id'); 

        $ejercicios = Ejercicio::pluck('nombreejercicio','id');
        
        $instituciones = Institucione::pluck('institucion', 'id');

        return view('poa.reportes', compact('usuarios','unidades', 'ejercicios', 'instituciones'));   
    }

    public function reporte_pdf(Request $request)
    {
      
        $unidadAdministrativa = $request->unidadadministrativa_id;

        $institucion = $request->institucion_id;
        $ejercicio = $request->ejercicio_id;
        
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
        $poas = Poa::institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_poa = count($poas);
        $total_monto_proyecto = $poas->sum('montoproyecto');
        $datos = [
            'total_poa' => $total_poa,
            'monto_proyecto' => $total_monto_proyecto,
            'usuario' =>$nombre_usuario,  
            'unidad' => $nombre_unidad,
            'ejercicio' => $nombre_ejercicio,
            'institucion' => $nombre_institucion,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('poa.reportepdf', ['datos'=>$datos, 'poas'=>$poas]);
        return $pdf->stream();
    }
}
