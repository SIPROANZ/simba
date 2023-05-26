<?php

namespace App\Http\Controllers;

use App\Objetivomunicipale;
use Illuminate\Http\Request;

use PDF;

/**
 * Class ObjetivomunicipaleController
 * @package App\Http\Controllers
 */
class ObjetivomunicipaleController extends Controller
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
       // $objetivomunicipales = Objetivomunicipale::paginate();

        $objetivomunicipales = Objetivomunicipale::query()
        ->when(request('search'), function($query) {
            return $query->where ('objetivo', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('objetivomunicipale.index', compact('objetivomunicipales'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivomunicipales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivomunicipale = new Objetivomunicipale();
        return view('objetivomunicipale.create', compact('objetivomunicipale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivomunicipale::$rules);

        $objetivomunicipale = Objetivomunicipale::create($request->all());

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id);

        return view('objetivomunicipale.show', compact('objetivomunicipale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id);

        return view('objetivomunicipale.edit', compact('objetivomunicipale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivomunicipale $objetivomunicipale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivomunicipale $objetivomunicipale)
    {
        request()->validate(Objetivomunicipale::$rules);

        $objetivomunicipale->update($request->all());

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id)->delete();

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale deleted successfully');
    }


    public function reportes()
    {
        return view('objetivomunicipale.reportes');   
    }

    public function reporte_pdf(Request $request)
    {
        $objetivo = $request->objetivo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        
        //
        $objetivomunicipales= Objetivomunicipale::objetivos($objetivo)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($objetivomunicipales);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'objetivo' => $objetivo,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('objetivomunicipale.reportepdf', ['datos'=>$datos, 'objetivomunicipales'=>$objetivomunicipales]);
        return $pdf->stream();
    }
}
