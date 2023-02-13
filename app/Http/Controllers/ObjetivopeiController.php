<?php

namespace App\Http\Controllers;

use App\Objetivopei;
use App\Objetivomunicipale;
use Illuminate\Http\Request;

/**
 * Class ObjetivopeiController
 * @package App\Http\Controllers
 */
class ObjetivopeiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetivopeis = Objetivopei::paginate();

        return view('objetivopei.index', compact('objetivopeis'))
            ->with('i', (request()->input('page', 1) - 1) * $objetivopeis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetivopei = new Objetivopei();
        $objetivomunicipale = Objetivomunicipale::pluck('objetivo', 'id');
        //dd($objetivomunicipale);
        return view('objetivopei.create', compact('objetivopei','objetivomunicipale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Objetivopei::$rules);

        $objetivopei = Objetivopei::create($request->all());

        return redirect()->route('objetivopeis.index')
            ->with('success', 'Objetivo PEI creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetivopei = Objetivopei::find($id);

        return view('objetivopei.show', compact('objetivopei'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetivopei = Objetivopei::find($id);
        $objetivomunicipale = Objetivomunicipale::pluck('objetivo', 'id');
        return view('objetivopei.edit', compact('objetivopei','objetivomunicipale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Objetivopei $objetivopei
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objetivopei $objetivopei)
    {
        request()->validate(Objetivopei::$rules);

        $objetivopei->update($request->all());

        return redirect()->route('objetivopeis.index')
            ->with('success', 'Objetivo PEI modificada con Exito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $objetivopei = Objetivopei::find($id)->delete();

        return redirect()->route('objetivopeis.index')
            ->with('success', 'Objetivo PEI eliminada con Exito');
    }
}
