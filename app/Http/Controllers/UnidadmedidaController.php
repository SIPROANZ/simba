<?php

namespace App\Http\Controllers;

use App\Unidadmedida;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

/**
 * Class UnidadmedidaController
 * @package App\Http\Controllers
 */
class UnidadmedidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.bos')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // $unidadmedidas = Unidadmedida::paginate();

        $unidadmedidas = Unidadmedida::query()
        ->when(request('search'), function($query){
            return $query->where('nombre', 'like', '%'.request('search').'%')
                         ->orWhereHas('usuario', function($q){
                          $q->where('name', 'like', '%'.request('search').'%');
                          })->orderBy('nombre', 'DESC');
         },
         function ($query) {
             $query->orderBy('nombre', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('unidadmedida.index', compact('unidadmedidas'))
            ->with('i', (request()->input('page', 1) - 1) * $unidadmedidas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidadmedida = new Unidadmedida();
        return view('unidadmedida.create', compact('unidadmedida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Unidadmedida::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $unidadmedida = Unidadmedida::create($request->all());

        return redirect()->route('unidadmedidas.index')
            ->with('success', 'Unidad de Medida creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadmedida = Unidadmedida::find($id);

        return view('unidadmedida.show', compact('unidadmedida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidadmedida = Unidadmedida::find($id);

        return view('unidadmedida.edit', compact('unidadmedida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Unidadmedida $unidadmedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidadmedida $unidadmedida)
    {
        request()->validate(Unidadmedida::$rules);

        $unidadmedida->update($request->all());

        return redirect()->route('unidadmedidas.index')
            ->with('success', 'Unidad de Medida actualizada con exito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unidadmedida = Unidadmedida::find($id)->delete();

        return redirect()->route('unidadmedidas.index')
            ->with('success', 'Unidad de Medida elimimada con exito');
    }


    public function reportes()
    {
        $usuarios = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('unidadmedida.reportes', compact('usuarios'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $usuario = $request->usuario;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        

        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }

        $unidadmedidas = Unidadmedida::descripcion($descripcion)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($unidadmedidas);
        
        $datos = [
            'usuario' => $nombre_usuario,
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('unidadmedida.reportepdf', ['datos'=>$datos, 'unidadmedidas'=>$unidadmedidas]);
        return $pdf->stream();
         
    }
}
