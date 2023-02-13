<?php

namespace App\Http\Controllers;

use App\Clasificadorpresupuestario;
use Illuminate\Http\Request;

/**
 * Class ClasificadorpresupuestarioController
 * @package App\Http\Controllers
 */
class ClasificadorpresupuestarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clasificadorpresupuestarios = Clasificadorpresupuestario::paginate();

        return view('clasificadorpresupuestario.index', compact('clasificadorpresupuestarios'))
            ->with('i', (request()->input('page', 1) - 1) * $clasificadorpresupuestarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clasificadorpresupuestario = new Clasificadorpresupuestario();
        return view('clasificadorpresupuestario.create', compact('clasificadorpresupuestario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Clasificadorpresupuestario::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $clasificadorpresupuestario = Clasificadorpresupuestario::create($request->all());

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id);

        return view('clasificadorpresupuestario.show', compact('clasificadorpresupuestario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id);

        return view('clasificadorpresupuestario.edit', compact('clasificadorpresupuestario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Clasificadorpresupuestario $clasificadorpresupuestario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clasificadorpresupuestario $clasificadorpresupuestario)
    {
        request()->validate(Clasificadorpresupuestario::$rules);

        $clasificadorpresupuestario->update($request->all());

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clasificadorpresupuestario = Clasificadorpresupuestario::find($id)->delete();

        return redirect()->route('clasificadorpresupuestarios.index')
            ->with('success', 'Clasificador presupuestario eliminado exitosamente');
    }
}
