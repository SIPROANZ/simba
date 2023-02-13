<?php

namespace App\Http\Controllers;

use App\Objetivomunicipale;
use Illuminate\Http\Request;

/**
 * Class ObjetivomunicipaleController
 * @package App\Http\Controllers
 */
class ObjetivomunicipaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivomunicipales = Objetivomunicipale::paginate();

        return view('objetivomunicipale.index', compact('objetivomunicipales'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivomunicipales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivomunicipale = new Objetivomunicipale();
        return view('objetivomunicipale.create', compact('objetivomunicipale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivomunicipale::$rules);

        $objetivomunicipale = Objetivomunicipale::create($request->all());

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id);

        return view('objetivomunicipale.show', compact('objetivomunicipale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id);

        return view('objetivomunicipale.edit', compact('objetivomunicipale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivomunicipale $objetivomunicipale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivomunicipale $objetivomunicipale)
    {
        request()->validate(Objetivomunicipale::$rules);

        $objetivomunicipale->update($request->all());

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivomunicipale = Objetivomunicipale::find($id)->delete();

        return redirect()->route('objetivomunicipales.index')
            ->with('success', 'Objetivomunicipale deleted successfully');
    }
}
