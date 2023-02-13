<?php

namespace App\Http\Controllers;

use App\Objetivoshistorico;
use Illuminate\Http\Request;

/**
 * Class ObjetivoshistoricoController
 * @package App\Http\Controllers
 */
class ObjetivoshistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivoshistoricos = Objetivoshistorico::paginate();

        return view('objetivoshistorico.index', compact('objetivoshistoricos'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivoshistoricos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivoshistorico = new Objetivoshistorico();
        return view('objetivoshistorico.create', compact('objetivoshistorico'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivoshistorico::$rules);

        $objetivoshistorico = Objetivoshistorico::create($request->all());

        return redirect()->route('objetivoshistoricos.index')
            ->with('success', 'Objetivo Historico creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivoshistorico = Objetivoshistorico::find($id);

        return view('objetivoshistorico.show', compact('objetivoshistorico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivoshistorico = Objetivoshistorico::find($id);

        return view('objetivoshistorico.edit', compact('objetivoshistorico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivoshistorico $objetivoshistorico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivoshistorico $objetivoshistorico)
    {
        request()->validate(Objetivoshistorico::$rules);

        $objetivoshistorico->update($request->all());

        return redirect()->route('objetivoshistoricos.index')
            ->with('success', 'Objetivoshistorico updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivoshistorico = Objetivoshistorico::find($id)->delete();

        return redirect()->route('objetivoshistoricos.index')
            ->with('success', 'Objetivoshistorico deleted successfully');
    }
}
