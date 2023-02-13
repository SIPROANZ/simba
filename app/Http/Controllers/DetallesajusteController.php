<?php

namespace App\Http\Controllers;

use App\Detallesajuste;
use App\Ajustescompromiso;
use Illuminate\Http\Request;

/**
 * Class DetallesajusteController
 * @package App\Http\Controllers
 */
class DetallesajusteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detallesajustes = Detallesajuste::paginate();

        return view('detallesajuste.index', compact('detallesajustes'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesajustes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detallesajuste = new Detallesajuste();
        return view('detallesajuste.create', compact('detallesajuste'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Detallesajuste::$rules);

        $detallesajuste = Detallesajuste::create($request->all());

        return redirect()->route('detallesajustes.index')
            ->with('success', 'Detallesajuste created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallesajuste = Detallesajuste::find($id);

        return view('detallesajuste.show', compact('detallesajuste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallesajuste = Detallesajuste::find($id);

        return view('detallesajuste.edit', compact('detallesajuste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detallesajuste $detallesajuste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detallesajuste $detallesajuste)
    {
        request()->validate(Detallesajuste::$rules);

        $detallesajuste->update($request->all());

           /*  return redirect()->route('detallesajustes.index')
            ->with('success', 'Detallesajuste updated successfully'); */
            $ajuste_id = session('ajustecompromiso');
            $ajustescompromiso = Ajustescompromiso::find($ajuste_id);

        //return view('ajustescompromiso.show', compact('ajustescompromiso'));

        $detallesajustes = Detallesajuste::where('ajustes_id', $ajuste_id)->paginate();



            return view('ajustescompromiso.show', compact('detallesajustes', 'ajustescompromiso'))
            ->with('i', (request()->input('page', 1) - 1) * $detallesajustes->perPage());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detallesajuste = Detallesajuste::find($id)->delete();

        return redirect()->route('detallesajustes.index')
            ->with('success', 'Detallesajuste deleted successfully');
    }
}
