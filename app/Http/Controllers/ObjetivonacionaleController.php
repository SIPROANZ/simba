<?php

namespace App\Http\Controllers;

use App\Objetivonacionale;
use App\Objetivoshistorico;
use Illuminate\Http\Request;
use PDF;

/**
 * Class ObjetivonacionaleController
 * @package App\Http\Controllers
 */
class ObjetivonacionaleController extends Controller
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
       // $objetivonacionales = Objetivonacionale::paginate();

        $objetivonacionales = Objetivonacionale::query()
        ->when(request('search'), function($query) {
            return $query->where ('objetivo', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('objetivonacionale.index', compact('objetivonacionales'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivonacionales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivonacionale = new Objetivonacionale();
        $historicos = Objetivoshistorico::pluck('objetivo', 'id');
        return view('objetivonacionale.create', compact('objetivonacionale', 'historicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivonacionale::$rules);

        $objetivonacionale = Objetivonacionale::create($request->all());

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivo Nacional creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivonacionale = Objetivonacionale::find($id);

        return view('objetivonacionale.show', compact('objetivonacionale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivonacionale = Objetivonacionale::find($id);
        $historicos = Objetivoshistorico::pluck('objetivo', 'id');
        return view('objetivonacionale.edit', compact('objetivonacionale', 'historicos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivonacionale $objetivonacionale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivonacionale $objetivonacionale)
    {
        request()->validate(Objetivonacionale::$rules);

        $objetivonacionale->update($request->all());

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivonacionale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivonacionale = Objetivonacionale::find($id)->delete();

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivonacionale deleted successfully');
    }

    public function reportes()
    {
        $historicos = Objetivoshistorico::orderBy('objetivo', 'ASC')->pluck('objetivo', 'id');
        return view('objetivonacionale.reportes', compact('historicos'));   
    }

    public function reporte_pdf(Request $request)
    {
        $objetivo = $request->objetivo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $historico = $request->historico;

        $nombre_historico = '';
        $rs_historico = Objetivoshistorico::find($historico);
        if($rs_historico){
            $nombre_historico = $rs_historico->objetivo;
        }
        
        //
        $objetivonacionales = Objetivonacionale::historicos($historico)->objetivos($objetivo)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($objetivonacionales);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'objetivo' => $objetivo,
            'historico' => $nombre_historico,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('objetivonacionale.reportepdf', ['datos'=>$datos, 'objetivonacionales'=>$objetivonacionales]);
        return $pdf->stream();
    }
}
