<?php

namespace App\Http\Controllers;

use App\Requidetbo;
use Illuminate\Http\Request;

/**
 * Class RequidetboController
 * @package App\Http\Controllers
 */
class RequidetboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requidetbos = Requidetbo::paginate();

        return view('requidetbo.index', compact('requidetbos'))
            ->with('i', (request()->input('page', 1) - 1) * $requidetbos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requidetbo = new Requidetbo();
        return view('requidetbo.create', compact('requidetbo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requidetbo::$rules);

        $requidetbo = Requidetbo::create($request->all());

        return redirect()->route('requidetbos.index')
            ->with('success', 'Requidetbo creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requidetbo = Requidetbo::find($id);

        return view('requidetbo.show', compact('requidetbo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requidetbo = Requidetbo::find($id);

        return view('requidetbo.edit', compact('requidetbo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requidetbo $requidetbo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requidetbo $requidetbo)
    {
        request()->validate(Requidetbo::$rules);

        $requidetbo->update($request->all());

        return redirect()->route('requidetbos.index')
            ->with('success', 'Requidetbo actualizado con éxito');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requidetbo = Requidetbo::find($id)->delete();

        return redirect()->route('requidetbos.index')
            ->with('success', 'Requidetbo eliminado con éxito');
    }
}
