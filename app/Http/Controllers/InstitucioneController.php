<?php

namespace App\Http\Controllers;

use App\Institucione;
use App\Municipio;
use Illuminate\Http\Request;

/**
 * Class InstitucioneController
 * @package App\Http\Controllers
 */
class InstitucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucione::paginate();

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
        $institucione = Institucione::create($data->all());

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
}
