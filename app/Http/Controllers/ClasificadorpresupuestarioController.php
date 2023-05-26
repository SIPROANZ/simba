<?php

namespace App\Http\Controllers;

use App\Clasificadorpresupuestario;
use App\Models\User;
use Illuminate\Http\Request;

use PDF;

/**
 * Class ClasificadorpresupuestarioController
 * @package App\Http\Controllers
 */
class ClasificadorpresupuestarioController extends Controller
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
       // $clasificadorpresupuestarios = Clasificadorpresupuestario::paginate();

        $clasificadorpresupuestarios = Clasificadorpresupuestario::query()
        ->when(request('search'), function($query){
            return $query->where ('cuenta', 'like', '%'.request('search').'%')
                         ->orWhere('denominacion', 'like', '%'.request('search').'%');
         },
         function ($query) {
             $query->orderBy('cuenta', 'ASC');
         })
        ->paginate(25)
        ->withQueryString();

        return view('clasificadorpresupuestario.index', compact('clasificadorpresupuestarios'))
            ->with('i', (request()->input('page', 1) - 1) * $clasificadorpresupuestarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clasificadorpresupuestario = new Clasificadorpresupuestario();
        return view('clasificadorpresupuestario.create', compact('clasificadorpresupuestario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clasificadorpresupuestario::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $clasificadorpresupuestario = Clasificadorpresupuestario::create($request->all());

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id);

        return view('clasificadorpresupuestario.show', compact('clasificadorpresupuestario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id);

        return view('clasificadorpresupuestario.edit', compact('clasificadorpresupuestario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clasificadorpresupuestario $clasificadorpresupuestario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clasificadorpresupuestario $clasificadorpresupuestario)
    {
        request()->validate(Clasificadorpresupuestario::$rules);

        $clasificadorpresupuestario->update($request->all());

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id)->delete();

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario eliminado exitosamente');
    }

    public function reportes()
    {
        $usuarios = User::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('clasificadorpresupuestario.reportes', compact('usuarios'));   
    }

    public function reporte_pdf(Request $request)
    {
        $clasificador = $request->clasificador;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $usuario = $request->usuario;

        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }
        
        //
        $clasificadorpresupuestarios = Clasificadorpresupuestario::clasificador($clasificador)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($clasificadorpresupuestarios);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'clasificador' => $clasificador,
            'usuario' => $nombre_usuario,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('clasificadorpresupuestario.reportepdf', ['datos'=>$datos, 'clasificadorpresupuestarios'=>$clasificadorpresupuestarios]);
        return $pdf->stream();
    }
}
