<?php

namespace App\Http\Controllers;

use App\Unidade;
use App\Gabinete;
use Illuminate\Http\Request;

/**
 * Class UnidadeController
 * @package App\Http\Controllers
 */
class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidade::paginate();

        return view('unidade.index', compact('unidades'))
            ->with('i', (request()->input('page', 1) - 1) * $unidades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidade = new Unidade();
        $gabinetes = Gabinete::pluck('nombre', 'id');
        return view('unidade.create', compact('unidade', 'gabinetes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Unidade::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);

        $unidade = Unidade::create($request->all());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidade = Unidade::find($id);

        return view('unidade.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidade = Unidade::find($id);
        $gabinetes = Gabinete::pluck('nombre', 'id');

        return view('unidade.edit', compact('unidade', 'gabinetes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Unidade $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidade $unidade)
    {
        request()->validate(Unidade::$rules);

        $unidade->update($request->all());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $unidade = Unidade::find($id)->delete();

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade deleted successfully');
    }
}
