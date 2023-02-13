<?php

namespace App\Http\Controllers;

use App\Segmento;
use Illuminate\Http\Request;

/**
 * Class SegmentoController
 * @package App\Http\Controllers
 */
class SegmentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $segmentos = Segmento::paginate();

        return view('segmento.index', compact('segmentos'))
            ->with('i', (request()->input('page', 1) - 1) * $segmentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $segmento = new Segmento();
        return view('segmento.create', compact('segmento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Segmento::$rules);

        $segmento = Segmento::create($request->all());

        return redirect()->route('segmentos.index')
            ->with('success', 'Segmento creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $segmento = Segmento::find($id);

        return view('segmento.show', compact('segmento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $segmento = Segmento::find($id);

        return view('segmento.edit', compact('segmento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Segmento $segmento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segmento $segmento)
    {
        request()->validate(Segmento::$rules);

        $segmento->update($request->all());

        return redirect()->route('segmentos.index')
            ->with('success', 'Segmento actualizado con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $segmento = Segmento::find($id)->delete();

        return redirect()->route('segmentos.index')
            ->with('success', 'Segmento eliminado con éxito');
    }
}
