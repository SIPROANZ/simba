<?php

namespace App\Http\Controllers;

use App\Tipobo;
use Illuminate\Http\Request;

/**
 * Class TipoboController
 * @package App\Http\Controllers
 */
class TipoboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipobos = Tipobo::paginate();

        return view('tipobo.index', compact('tipobos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipobos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipobo = new Tipobo();
        return view('tipobo.create', compact('tipobo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipobo::$rules);

        $tipobo = Tipobo::create($request->all());

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipobo = Tipobo::find($id);

        return view('tipobo.show', compact('tipobo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipobo = Tipobo::find($id);

        return view('tipobo.edit', compact('tipobo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipobo $tipobo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipobo $tipobo)
    {
        request()->validate(Tipobo::$rules);

        $tipobo->update($request->all());

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipobo = Tipobo::find($id)->delete();

        return redirect()->route('tipobos.index')
            ->with('success', 'Tipo BOS eliminado exitosamente');
    }
}
