<?php

namespace App\Http\Controllers;

use App\Financiamiento;
use Illuminate\Http\Request;

/**
 * Class FinanciamientoController
 * @package App\Http\Controllers
 */
class FinanciamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financiamientos = Financiamiento::paginate();

        return view('financiamiento.index', compact('financiamientos'))
            ->with('i', (request()->input('page', 1) - 1) * $financiamientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $financiamiento = new Financiamiento();
        return view('financiamiento.create', compact('financiamiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Financiamiento::$rules);

        $financiamiento = Financiamiento::create($request->all());

        return redirect()->route('financiamientos.index')
            ->with('success', 'Financiamiento creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $financiamiento = Financiamiento::find($id);

        return view('financiamiento.show', compact('financiamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $financiamiento = Financiamiento::find($id);

        return view('financiamiento.edit', compact('financiamiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Financiamiento $financiamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Financiamiento $financiamiento)
    {
        request()->validate(Financiamiento::$rules);

        $financiamiento->update($request->all());

        return redirect()->route('financiamientos.index')
            ->with('success', 'Financiamiento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $financiamiento = Financiamiento::find($id)->delete();

        return redirect()->route('financiamientos.index')
            ->with('success', 'Financiamiento deleted successfully');
    }
}
