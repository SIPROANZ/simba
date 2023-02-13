<?php

namespace App\Http\Controllers;

use App\Detalleordenpago;
use Illuminate\Http\Request;

/**
 * Class DetalleordenpagoController
 * @package App\Http\Controllers
 */
class DetalleordenpagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalleordenpagos = Detalleordenpago::paginate();

        return view('detalleordenpago.index', compact('detalleordenpagos'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleordenpagos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleordenpago = new Detalleordenpago();
        return view('detalleordenpago.create', compact('detalleordenpago'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detalleordenpago::$rules);

        $detalleordenpago = Detalleordenpago::create($request->all());

        return redirect()->route('detalleordenpagos.index')
            ->with('success', 'Detalleordenpago created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleordenpago = Detalleordenpago::find($id);

        return view('detalleordenpago.show', compact('detalleordenpago'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleordenpago = Detalleordenpago::find($id);

        return view('detalleordenpago.edit', compact('detalleordenpago'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detalleordenpago $detalleordenpago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalleordenpago $detalleordenpago)
    {
        request()->validate(Detalleordenpago::$rules);

        $detalleordenpago->update($request->all());

        return redirect()->route('detalleordenpagos.index')
            ->with('success', 'Detalleordenpago updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleordenpago = Detalleordenpago::find($id)->delete();

        return redirect()->route('detalleordenpagos.index')
            ->with('success', 'Detalleordenpago deleted successfully');
    }
}
