<?php

namespace App\Http\Controllers;

use App\Tipomovimiento;
use Illuminate\Http\Request;

/**
 * Class TipomovimientoController
 * @package App\Http\Controllers
 */
class TipomovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipomovimientos = Tipomovimiento::paginate();

        return view('tipomovimiento.index', compact('tipomovimientos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipomovimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipomovimiento = new Tipomovimiento();
        return view('tipomovimiento.create', compact('tipomovimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipomovimiento::$rules);

        $tipomovimiento = Tipomovimiento::create($request->all());

        return redirect()->route('tipomovimientos.index')
            ->with('success', 'Tipomovimiento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipomovimiento = Tipomovimiento::find($id);

        return view('tipomovimiento.show', compact('tipomovimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipomovimiento = Tipomovimiento::find($id);

        return view('tipomovimiento.edit', compact('tipomovimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipomovimiento $tipomovimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipomovimiento $tipomovimiento)
    {
        request()->validate(Tipomovimiento::$rules);

        $tipomovimiento->update($request->all());

        return redirect()->route('tipomovimientos.index')
            ->with('success', 'Tipomovimiento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipomovimiento = Tipomovimiento::find($id)->delete();

        return redirect()->route('tipomovimientos.index')
            ->with('success', 'Tipomovimiento deleted successfully');
    }
}
 