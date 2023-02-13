<?php

namespace App\Http\Controllers;

use App\Detallescompromiso;
use Illuminate\Http\Request;

/**
 * Class DetallescompromisoController
 * @package App\Http\Controllers
 */
class DetallescompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallescompromisos = Detallescompromiso::paginate();

        return view('detallescompromiso.index', compact('detallescompromisos'))
            ->with('i', (request()->input('page', 1) - 1) * $detallescompromisos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallescompromiso = new Detallescompromiso();
        return view('detallescompromiso.create', compact('detallescompromiso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallescompromiso::$rules);

        $detallescompromiso = Detallescompromiso::create($request->all());

        return redirect()->route('detallescompromisos.index')
            ->with('success', 'Detallescompromiso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallescompromiso = Detallescompromiso::find($id);

        return view('detallescompromiso.show', compact('detallescompromiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallescompromiso = Detallescompromiso::find($id);

        return view('detallescompromiso.edit', compact('detallescompromiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallescompromiso $detallescompromiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallescompromiso $detallescompromiso)
    {
        request()->validate(Detallescompromiso::$rules);

        $detallescompromiso->update($request->all());

        return redirect()->route('detallescompromisos.index')
            ->with('success', 'Detallescompromiso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallescompromiso = Detallescompromiso::find($id)->delete();

        return redirect()->route('detallescompromisos.index')
            ->with('success', 'Detallescompromiso deleted successfully');
    }
}
