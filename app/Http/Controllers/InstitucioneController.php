<?php

namespace App\Http\Controllers;

use App\Institucione;
use App\Municipio;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class InstitucioneController
 * @package App\Http\Controllers
 */
class InstitucioneController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.instituciones')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $instituciones = Institucione::paginate();
        $instituciones = Institucione::query()
        ->when(request('search'), function($query) {
            return $query->where ('institucion', 'like', '%'.request('search').'%');
         })
        ->paginate(25)
        ->withQueryString();

        return view('institucione.index', compact('instituciones'))
            ->with('i', (request()->input('page', 1) - 1) * $instituciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institucione = new Institucione();
        $municipio = Municipio::pluck('nombre', 'id');
        return view('institucione.create', compact('institucione', 'municipio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        //dd($request)->validated()["logoinstitucion"]->getClientOriginalName();
        $data = $request;
        $data["logoinstitucion"] = $filename = time().".".$data["logoinstitucion"]->extension();
        $request->logoinstitucion->move(public_path("images"), $filename);
        dd($data["logoinstitucion"]);
        /*         if ($request->hasFile('logoinstitucion')) {
                    $institucione['logoinstitucion']=$request->file('logoinstitucion')->store('uploads','public');
                }
                if ($request->hasFile('organigrama')) {
                    $institucione['organigrama']=$request->file('organigrama')->store('uploads','public');
                }*/
        //$institucione=update($data->validated());

        

        //imagen
        $file = $request->file('logoinstitucion')->store('public/images');
        $url = Storage::url($file);
        //organigrama
        $organigrama = $request->file('organigrama')->store('public/images');
        $url_organigrama = Storage::url($organigrama);



        $institucione = Institucione::create($request->all());

          $institucione->logoinstitucion = $url;
          $institucione->save();

          $institucione->organigrama = $url_organigrama;
          $institucione->save();

        return redirect()->route('instituciones.index')
            ->with('success', 'Institución creada con Exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institucione = Institucione::find($id);

        return view('institucione.show', compact('institucione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institucione = Institucione::find($id);
        $municipio = Municipio::pluck('nombre', 'id');

        return view('institucione.edit', compact('institucione', 'municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Institucione $institucione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institucione $institucione)
    {
        request()->validate(Institucione::$rules);
        //dd($request)->validated()["logoinstitucion"]->getClientOriginalName();

        $data = $request;

        $data["logoinstitucion"] = $filename = time().".".$data["logoinstitucion"]->extension();
        $request->logoinstitucion->move(public_path("images"), $filename);
        $institucione->update($data);

        return redirect()->route('instituciones.index')
            ->with('success', 'Institución modificada con Exito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $institucione = Institucione::find($id)->delete();

        return redirect()->route('instituciones.index')
            ->with('success', 'Institución eliminada con Exito');
    }


    public function reportes()
    {
        $municipios = Municipio::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('institucione.reportes', compact('municipios'));   
    }

    public function reporte_pdf(Request $request)
    {
        $institucion = $request->institucion;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $municipio = $request->municipio;

        $nombre_municipio = '';
        $rs_municipio = Municipio::find($municipio);
        if($rs_municipio){
            $nombre_municipio = $rs_municipio->nombre;
        }
        
        //
        $instituciones = Institucione::municipios($municipio)->institucion($institucion)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($instituciones);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'institucion' => $institucion,
            'municipio' => $nombre_municipio,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'landscape')->loadView('institucione.reportepdf', ['datos'=>$datos, 'instituciones'=>$instituciones]);
        return $pdf->stream();
    }
}
