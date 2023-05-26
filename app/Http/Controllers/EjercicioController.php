<?php

namespace App\Http\Controllers;

use App\Ejercicio;
use Illuminate\Http\Request;
use PDF;

/**
 * Class EjercicioController
 * @package App\Http\Controllers
 */
class EjercicioController extends Controller
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
       // $ejercicios = Ejercicio::paginate();

        $ejercicios = Ejercicio::query()
        ->when(request('search'), function($query) {
            return $query->where ('nombreejercicio', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('ejercicio.index', compact('ejercicios'))
            ->with('i', (request()->input('page', 1) - 1) * $ejercicios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejercicio = new Ejercicio();
        return view('ejercicio.create', compact('ejercicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ejercicio::$rules);

        $ejercicio = Ejercicio::create($request->all());

        return redirect()->route('ejercicios.index')
            ->with('success', 'Ejercicio creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejercicio = Ejercicio::find($id);

        return view('ejercicio.show', compact('ejercicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejercicio = Ejercicio::find($id);

        return view('ejercicio.edit', compact('ejercicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ejercicio $ejercicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejercicio $ejercicio)
    {
        request()->validate(Ejercicio::$rules);

        $ejercicio->update($request->all());

        return redirect()->route('ejercicios.index')
            ->with('success', 'Ejercicio actualizado con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ejercicio = Ejercicio::find($id)->delete();

        return redirect()->route('ejercicios.index')
            ->with('success', 'Ejercicio eliminado con éxito');
    }

    public function reportes()
    {
        return view('ejercicio.reportes');   
    }

    public function reporte_pdf(Request $request)
    {
        
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        $ejercicios = Ejercicio::fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($ejercicios);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('ejercicio.reportepdf', ['datos'=>$datos, 'ejercicios'=>$ejercicios]);
        return $pdf->stream();
    }
}
