<?php

namespace App\Http\Controllers;

use App\Tiporetencione;
use Illuminate\Http\Request;

/**
 * Class TiporetencioneController
 * @package App\Http\Controllers
 */
class TiporetencioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiporetenciones = Tiporetencione::paginate();

        return view('tiporetencione.index', compact('tiporetenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $tiporetenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiporetencione = new Tiporetencione();
        return view('tiporetencione.create', compact('tiporetencione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tiporetencione::$rules);

        $tiporetencione = Tiporetencione::create($request->all());

        return redirect()->route('tiporetenciones.index')
            ->with('success', 'Tipo de Retención creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiporetencione = Tiporetencione::find($id);

        return view('tiporetencione.show', compact('tiporetencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tiporetencione = Tiporetencione::find($id);

        return view('tiporetencione.edit', compact('tiporetencione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tiporetencione $tiporetencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiporetencione $tiporetencione)
    {
        request()->validate(Tiporetencione::$rules);

        $tiporetencione->update($request->all());

        return redirect()->route('tiporetenciones.index')
            ->with('success', 'Tipo de Retención modificada con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tiporetencione = Tiporetencione::find($id)->delete();

        return redirect()->route('tiporetenciones.index')
            ->with('success', 'Tipo de Retención eliminada con exito');
    }
}
