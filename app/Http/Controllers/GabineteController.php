<?php

namespace App\Http\Controllers;

use App\Gabinete;
use Illuminate\Http\Request;

/**
 * Class GabineteController
 * @package App\Http\Controllers
 */
class GabineteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gabinetes = Gabinete::paginate();

        return view('gabinete.index', compact('gabinetes'))
            ->with('i', (request()->input('page', 1) - 1) * $gabinetes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gabinete = new Gabinete();
        return view('gabinete.create', compact('gabinete'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Gabinete::$rules);


        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $gabinete = Gabinete::create($request->all());

        return redirect()->route('gabinetes.index')
            ->with('success', 'Gabinete created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gabinete = Gabinete::find($id);

        return view('gabinete.show', compact('gabinete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gabinete = Gabinete::find($id);

        return view('gabinete.edit', compact('gabinete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Gabinete $gabinete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gabinete $gabinete)
    {
        request()->validate(Gabinete::$rules);

        $gabinete->update($request->all());

        return redirect()->route('gabinetes.index')
            ->with('success', 'Gabinete updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $gabinete = Gabinete::find($id)->delete();

        return redirect()->route('gabinetes.index')
            ->with('success', 'Gabinete deleted successfully');
    }
}
