<?php

namespace App\Http\Controllers;

use App\Retencione;
use App\Tiporetencione;
use Illuminate\Http\Request;

/**
 * Class RetencioneController
 * @package App\Http\Controllers
 */
class RetencioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retenciones = Retencione::paginate();

        return view('retencione.index', compact('retenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $retenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $retencione = new Retencione();
        $tiporetencion = Tiporetencione::pluck('tipo', 'id');
        return view('retencione.create', compact('retencione', 'tiporetencion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Retencione::$rules);

        $retencione = Retencione::create($request->all());

        return redirect()->route('retenciones.index')
            ->with('success', 'Retención creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retencione = Retencione::find($id);

        return view('retencione.show', compact('retencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retencione = Retencione::find($id);
        $tiporetencion = Tiporetencione::pluck('tipo', 'id');

        return view('retencione.edit', compact('retencione', 'tiporetencion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Retencione $retencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retencione $retencione)
    {
        request()->validate(Retencione::$rules);

        $retencione->update($request->all());

        return redirect()->route('retenciones.index')
            ->with('success', 'Retención modificada con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $retencione = Retencione::find($id)->delete();

        return redirect()->route('retenciones.index')
            ->with('success', 'Retención eliminada con exito');
    }
}
