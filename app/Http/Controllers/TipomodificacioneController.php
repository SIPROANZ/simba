<?php

namespace App\Http\Controllers;

use App\Tipomodificacione;
use Illuminate\Http\Request;

/**
 * Class TipomodificacioneController
 * @package App\Http\Controllers
 */
class TipomodificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipomodificaciones = Tipomodificacione::paginate();

        return view('tipomodificacione.index', compact('tipomodificaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $tipomodificaciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipomodificacione = new Tipomodificacione();
        return view('tipomodificacione.create', compact('tipomodificacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipomodificacione::$rules);

        $tipomodificacione = Tipomodificacione::create($request->all());

        return redirect()->route('tipomodificaciones.index')
            ->with('success', 'Tipomodificacione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipomodificacione = Tipomodificacione::find($id);

        return view('tipomodificacione.show', compact('tipomodificacione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomodificacione = Tipomodificacione::find($id);

        return view('tipomodificacione.edit', compact('tipomodificacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipomodificacione $tipomodificacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipomodificacione $tipomodificacione)
    {
        request()->validate(Tipomodificacione::$rules);

        $tipomodificacione->update($request->all());

        return redirect()->route('tipomodificaciones.index')
            ->with('success', 'Tipomodificacione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipomodificacione = Tipomodificacione::find($id)->delete();

        return redirect()->route('tipomodificaciones.index')
            ->with('success', 'Tipomodificacione deleted successfully');
    }
}
