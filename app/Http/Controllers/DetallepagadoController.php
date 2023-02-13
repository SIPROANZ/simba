<?php

namespace App\Http\Controllers;

use App\Detallepagado;
use Illuminate\Http\Request;

/**
 * Class DetallepagadoController
 * @package App\Http\Controllers
 */
class DetallepagadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallepagados = Detallepagado::paginate();

        return view('detallepagado.index', compact('detallepagados'))
            ->with('i', (request()->input('page', 1) - 1) * $detallepagados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallepagado = new Detallepagado();
        return view('detallepagado.create', compact('detallepagado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallepagado::$rules);

        $detallepagado = Detallepagado::create($request->all());

        return redirect()->route('detallepagados.index')
            ->with('success', 'Detallepagado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallepagado = Detallepagado::find($id);

        return view('detallepagado.show', compact('detallepagado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallepagado = Detallepagado::find($id);

        return view('detallepagado.edit', compact('detallepagado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallepagado $detallepagado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallepagado $detallepagado)
    {
        request()->validate(Detallepagado::$rules);

        $detallepagado->update($request->all());

        return redirect()->route('detallepagados.index')
            ->with('success', 'Detallepagado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallepagado = Detallepagado::find($id)->delete();

        return redirect()->route('detallepagados.index')
            ->with('success', 'Detallepagado deleted successfully');
    }
}
