<?php

namespace App\Http\Controllers;

use App\Unidadadministrativa;
use App\Ejercicio;
use App\Institucione;
use App\Configuracione;
use Illuminate\Http\Request;
use PDF;
use App\Models\User;

/**
 * Class UnidadadministrativaController
 * @package App\Http\Controllers
 */
class UnidadadministrativaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.ejecuciones')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener el id del ejercio para el POA que quiero mostrar
       $rs_unidad = Configuracione::where('nombre', 'unidad_ejercicio')->first();
       $unidad_id = 1;
       if($rs_unidad){
        $unidad_id = $rs_unidad->valor;
       }

        $unidadadministrativas = Unidadadministrativa::query()
        ->when(request('search'), function($query) use ($unidad_id){
            return $query->where('ejercicio_id', $unidad_id)
                          ->where('denominacion', 'like', '%'.request('search').'%')
                            ->orWhere('unidadejecutora', 'like', '%'.request('search').'%')
                         ->orWhereHas('usuario', function($q){
                          $q->where('name', 'like', '%'.request('search').'%');
                          })->orderBy('unidadejecutora', 'DESC');
         },
         function ($query) use ($unidad_id){
             $query->where('ejercicio_id', $unidad_id)
             ->orderBy('unidadejecutora', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('unidadadministrativa.index', compact('unidadadministrativas'))
            ->with('i', (request()->input('page', 1) - 1) * $unidadadministrativas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadadministrativa = new Unidadadministrativa();
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 
        $instituciones = Institucione::pluck('institucion', 'id');
        return view('unidadadministrativa.create', compact('unidadadministrativa' , 'ejercicio', 'instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Unidadadministrativa::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $unidadadministrativa = Unidadadministrativa::create($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);

        return view('unidadadministrativa.show', compact('unidadadministrativa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id);
        $ejercicio = Ejercicio::pluck('nombreejercicio', 'id'); 

        $instituciones = Institucione::pluck('institucion', 'id');

        return view('unidadadministrativa.edit', compact('unidadadministrativa', 'ejercicio', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Unidadadministrativa $unidadadministrativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidadadministrativa $unidadadministrativa)
    {
        request()->validate(Unidadadministrativa::$rules);

        $unidadadministrativa->update($request->all());

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa actualilzada con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unidadadministrativa = Unidadadministrativa::find($id)->delete();

        return redirect()->route('unidadadministrativas.index')
            ->with('success', 'Unidad administrativa eliminada con éxito');
    }

    public function reportes()
    {
        $instituciones = Institucione::orderBy('institucion', 'ASC')->pluck('institucion', 'id');
        $usuarios = User::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('unidadadministrativa.reportes', compact('instituciones', 'usuarios'));   
    }

    public function reporte_pdf(Request $request)
    {
        $unidad = $request->unidad;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $institucion = $request->institucion;
        $usuario =$request->usuario;

        $nombre_institucion = '';
        $rs_institucion = Institucione::find($institucion);
        if($rs_institucion){
            $nombre_institucion = $rs_institucion->institucion;
        }

        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }
        
        //
        $unidadadministrativas = Unidadadministrativa::institucion($institucion)->unidad($unidad)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($unidadadministrativas);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'unidad' => $unidad,
            'institucion' => $nombre_institucion,
            'usuario' => $nombre_usuario,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('unidadadministrativa.reportepdf', ['datos'=>$datos, 'unidadadministrativas'=>$unidadadministrativas]);
        return $pdf->stream();
    }
}
