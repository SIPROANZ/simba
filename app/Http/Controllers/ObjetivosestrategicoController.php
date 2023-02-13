<?php

namespace App\Http\Controllers;

use App\Objetivosestrategico;
use App\Objetivonacionale;
use Illuminate\Http\Request;

/**
 * Class ObjetivosestrategicoController
 * @package App\Http\Controllers
 */
class ObjetivosestrategicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivosestrategicos = Objetivosestrategico::paginate();

        return view('objetivosestrategico.index', compact('objetivosestrategicos'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivosestrategicos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivosestrategico = new Objetivosestrategico();

        $nacionales = Objetivonacionale::pluck('objetivo', 'id');
        return view('objetivosestrategico.create', compact('objetivosestrategico', 'nacionales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivosestrategico::$rules);

        $objetivosestrategico = Objetivosestrategico::create($request->all());

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivo Estrategico creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id);

        return view('objetivosestrategico.show', compact('objetivosestrategico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id);

        $nacionales = Objetivonacionale::pluck('objetivo', 'id');

        return view('objetivosestrategico.edit', compact('objetivosestrategico', 'nacionales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivosestrategico $objetivosestrategico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivosestrategico $objetivosestrategico)
    {
        request()->validate(Objetivosestrategico::$rules);

        $objetivosestrategico->update($request->all());

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivosestrategico updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivosestrategico = Objetivosestrategico::find($id)->delete();

        return redirect()->route('objetivosestrategicos.index')
            ->with('success', 'Objetivosestrategico deleted successfully');
    }
}
