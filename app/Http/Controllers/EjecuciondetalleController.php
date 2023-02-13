<?php

namespace App\Http\Controllers;

use App\Ejecuciondetalle;
//use App\Ejecucione;

//use App\Ejecucione;
use App\Financiamiento;

use Illuminate\Http\Request;

/**
 * Class EjecuciondetalleController
 * @package App\Http\Controllers
 */
class EjecuciondetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ejecuciondetalles = Ejecuciondetalle::paginate();

        return view('ejecuciondetalle.index', compact('ejecuciondetalles'))
            ->with('i', (request()->input('page', 1) - 1) * $ejecuciondetalles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejecuciondetalle = new Ejecuciondetalle();

        //$ejecuciones = Ejecucione::pluck('id','id');
        //return view('ejecuciondetalle.create', compact('ejecuciondetalle' ,'ejecuciones'));

        $financiamientos = Financiamiento::pluck('nombre','id');

        return view('ejecuciondetalle.create', compact('ejecuciondetalle', 'financiamientos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ejecuciondetalle::$rules);

        $ejecuciondetalle = Ejecuciondetalle::create($request->all());

        return redirect()->route('ejecuciondetalles.index')
            ->with('success', 'Detalle de Ejecución creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ejecuciondetalle = Ejecuciondetalle::find($id);

        return view('ejecuciondetalle.show', compact('ejecuciondetalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ejecuciondetalle = Ejecuciondetalle::find($id);

        $financiamientos = Financiamiento::pluck('nombre','id');

        return view('ejecuciondetalle.edit', compact('ejecuciondetalle', 'financiamientos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ejecuciondetalle $ejecuciondetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejecuciondetalle $ejecuciondetalle)
    {
        request()->validate(Ejecuciondetalle::$rules);

        $ejecuciondetalle->update($request->all());

        return redirect()->route('ejecuciondetalles.index')
            ->with('success', 'Ejecuciondetalle updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ejecuciondetalle = Ejecuciondetalle::find($id)->delete();

        return redirect()->route('ejecuciondetalles.index')
            ->with('success', 'Ejecuciondetalle deleted successfully');
    }
}
