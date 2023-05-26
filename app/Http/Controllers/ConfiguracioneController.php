<?php

namespace App\Http\Controllers;

use App\Configuracione;
use Illuminate\Http\Request;

/**
 * Class ConfiguracioneController
 * @package App\Http\Controllers
 */
class ConfiguracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones = Configuracione::paginate();

        return view('configuracione.index', compact('configuraciones'))
            ->with('i', (request()->input('page', 1) - 1) * $configuraciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configuracione = new Configuracione();
        return view('configuracione.create', compact('configuracione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Configuracione::$rules);

        $configuracione = Configuracione::create($request->all());

        return redirect()->route('configuraciones.index')
            ->with('success', 'Configuracion creada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configuracione = Configuracione::find($id);

        return view('configuracione.show', compact('configuracione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuracione = Configuracione::find($id);

        return view('configuracione.edit', compact('configuracione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Configuracione $configuracione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracione $configuracione)
    {
        request()->validate(Configuracione::$rules);

        $configuracione->update($request->all());

        return redirect()->route('configuraciones.index')
            ->with('success', 'Configuracion editada con exito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $configuracione = Configuracione::find($id)->delete();

        return redirect()->route('configuraciones.index')
            ->with('success', 'Configuracione eliminada con exito');
    }
}
