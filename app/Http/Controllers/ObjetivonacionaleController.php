<?php

namespace App\Http\Controllers;

use App\Objetivonacionale;
use App\Objetivoshistorico;
use Illuminate\Http\Request;

/**
 * Class ObjetivonacionaleController
 * @package App\Http\Controllers
 */
class ObjetivonacionaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivonacionales = Objetivonacionale::paginate();

        return view('objetivonacionale.index', compact('objetivonacionales'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivonacionales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivonacionale = new Objetivonacionale();
        $historicos = Objetivoshistorico::pluck('objetivo', 'id');
        return view('objetivonacionale.create', compact('objetivonacionale', 'historicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivonacionale::$rules);

        $objetivonacionale = Objetivonacionale::create($request->all());

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivo Nacional creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivonacionale = Objetivonacionale::find($id);

        return view('objetivonacionale.show', compact('objetivonacionale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivonacionale = Objetivonacionale::find($id);
        $historicos = Objetivoshistorico::pluck('objetivo', 'id');
        return view('objetivonacionale.edit', compact('objetivonacionale', 'historicos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivonacionale $objetivonacionale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivonacionale $objetivonacionale)
    {
        request()->validate(Objetivonacionale::$rules);

        $objetivonacionale->update($request->all());

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivonacionale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivonacionale = Objetivonacionale::find($id)->delete();

        return redirect()->route('objetivonacionales.index')
            ->with('success', 'Objetivonacionale deleted successfully');
    }
}
