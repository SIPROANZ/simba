<?php

namespace App\Http\Controllers;

use App\Comprobantesretencione;
use Illuminate\Http\Request;

/**
 * Class ComprobantesretencioneController
 * @package App\Http\Controllers
 */
class ComprobantesretencioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprobantesretenciones = Comprobantesretencione::paginate();

        return view('comprobantesretencione.index', compact('comprobantesretenciones'))
            ->with('i', (request()->input('page', 1) - 1) * $comprobantesretenciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comprobantesretencione = new Comprobantesretencione();
        return view('comprobantesretencione.create', compact('comprobantesretencione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comprobantesretencione::$rules);

        $comprobantesretencione = Comprobantesretencione::create($request->all());

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobantesretencione created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id);

        return view('comprobantesretencione.show', compact('comprobantesretencione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id);

        return view('comprobantesretencione.edit', compact('comprobantesretencione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comprobantesretencione $comprobantesretencione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comprobantesretencione $comprobantesretencione)
    {
        request()->validate(Comprobantesretencione::$rules);

        $comprobantesretencione->update($request->all());

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobantesretencione updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comprobantesretencione = Comprobantesretencione::find($id)->delete();

        return redirect()->route('comprobantesretenciones.index')
            ->with('success', 'Comprobantesretencione deleted successfully');
    }
}
