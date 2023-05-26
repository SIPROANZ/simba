<?php

namespace App\Http\Controllers;

use App\Meta;
use App\Poa;
use App\Ejercicio;
use App\Institucione;
use App\Configuracione;
use App\Unidadadministrativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use PDF;

/**
 * Class MetaController
 * @package App\Http\Controllers
 */
class MetaController extends Controller
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
        //$metas = Meta::paginate();

        //Obtener el id del ejercio para el POA que quiero mostrar
       $rs_meta = Configuracione::where('nombre', 'meta_ejercicio')->first();
       $meta_id = 1;
       if($rs_meta){
        $meta_id = $rs_meta->valor;
       }

        $metas = Meta::query()
        ->when(request('search'), function($query) use ($meta_id) {
            return $query->where('ejercicio_id', $meta_id)
                        ->where ('meta', 'like', '%'.request('search').'%')
                         //->orWhere('objetivoproyecto', 'like', '%'.request('search').'%')
                         ->orWhereHas('unidadadministrativa', function($q){
                          $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                          })
                           ->orWhereHas('usuario', function($qa){
                             $qa->where('name', 'like', '%'.request('search').'%');
                         });
         },
         function ($query) use ($meta_id) {
             $query->where('id', '>', 0)
             ->where('ejercicio_id', $meta_id)
             ->orderBy('id', 'DESC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('meta.index', compact('metas'))
            ->with('i', (request()->input('page', 1) - 1) * $metas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = new Meta();
        
        $poas= Poa::pluck('proyecto' , 'id');
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
        //$unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');
        $unidadadministrativas = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->pluck('name', 'id');




        return view('meta.create', compact('meta', 'poas', 'ejercicios' , 'instituciones' , 'unidadadministrativas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Meta::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $meta = Meta::create($request->all());

        return redirect()->route('metas.index')
            ->with('success', 'Meta creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meta = Meta::find($id);

        return view('meta.show', compact('meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = Meta::find($id);

        $poas= Poa::pluck('proyecto' , 'id');
        $ejercicios = Ejercicio::pluck('nombreejercicio' , 'id');
        $instituciones = Institucione::pluck('institucion', 'id');
       // $unidadadministrativas = Unidadadministrativa::pluck('sector', 'id');

       $unidadadministrativas = Unidadadministrativa::select(
        DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
        ->pluck('name', 'id');

        
        return view('meta.edit', compact('meta', 'poas', 'ejercicios' , 'instituciones' , 'unidadadministrativas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Meta $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        request()->validate(Meta::$rules);

        $meta->update($request->all());

        return redirect()->route('metas.index')
            ->with('success', 'Meta actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $meta = Meta::find($id)->delete();

        return redirect()->route('metas.index')
            ->with('success', 'Meta eliminado exitosamente');
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

        $poas = Poa::pluck('descripcion', 'id');

        return view('meta.reportes', compact('usuarios','unidades', 'ejercicios', 'instituciones', 'poas'));   
    }

    public function reporte_pdf(Request $request)
    {
      
        $unidadAdministrativa = $request->unidadadministrativa_id;

        $institucion = $request->institucion_id;
        $ejercicio = $request->ejercicio_id;
        
        $usuario = $request->usuario_id;
        $poa = $request->poa_id;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        $nombre_poa = '';
        $rs_poa = Poa::find($poa);
        if($rs_poa){
            $nombre_poa = $rs_poa->descripcion;
        }
        
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
        $metas = Meta::poas($poa)->institucion($institucion)->ejercicio($ejercicio)->unidad($unidadAdministrativa)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_poa = count($metas);
        $total_monto_proyecto = $metas->sum('monto');
        $datos = [
            'total_poa' => $total_poa,
            'monto_proyecto' => $total_monto_proyecto,
            'usuario' =>$nombre_usuario,  
            'unidad' => $nombre_unidad,
            'ejercicio' => $nombre_ejercicio,
            'institucion' => $nombre_institucion,
            'nombre_poa' => $nombre_poa,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('meta.reportepdf', ['datos'=>$datos, 'metas'=>$metas]);
        return $pdf->stream();
        
         
    }
}
