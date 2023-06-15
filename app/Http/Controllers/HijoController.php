<?php

namespace App\Http\Controllers;

use App\Hijo;
use Illuminate\Http\Request;

/**
 * Class HijoController
 * @package App\Http\Controllers
 */
class HijoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hijos = Hijo::paginate();

        return view('hijo.index', compact('hijos'))
            ->with('i', (request()->input('page', 1) - 1) * $hijos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hijo = new Hijo();
        return view('hijo.create', compact('hijo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Hijo::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $hijo = Hijo::create($request->all());

        return redirect()->route('hijos.index')
            ->with('success', 'Hijo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hijo = Hijo::find($id);

        return view('hijo.show', compact('hijo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hijo = Hijo::find($id);

        return view('hijo.edit', compact('hijo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Hijo $hijo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hijo $hijo)
    {
        request()->validate(Hijo::$rules);

        $hijo->update($request->all());

        return redirect()->route('hijos.index')
            ->with('success', 'Hijo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $hijo = Hijo::find($id)->delete();

        return redirect()->route('hijos.index')
            ->with('success', 'Hijo deleted successfully');
    }
}
