<?php

namespace App\Http\Controllers;

use App\Requidetclaspre;
use Illuminate\Http\Request;

/**
 * Class RequidetclaspreController
 * @package App\Http\Controllers
 */
class RequidetclaspreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requidetclaspres = Requidetclaspre::paginate();

        return view('requidetclaspre.index', compact('requidetclaspres'))
            ->with('i', (request()->input('page', 1) - 1) * $requidetclaspres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $requidetclaspre = new Requidetclaspre();
        return view('requidetclaspre.create', compact('requidetclaspre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Requidetclaspre::$rules);

        $requidetclaspre = Requidetclaspre::create($request->all());

        return redirect()->route('requidetclaspres.index')
            ->with('success', 'Requidetclaspre created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requidetclaspre = Requidetclaspre::find($id);

        return view('requidetclaspre.show', compact('requidetclaspre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requidetclaspre = Requidetclaspre::find($id);

        return view('requidetclaspre.edit', compact('requidetclaspre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Requidetclaspre $requidetclaspre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requidetclaspre $requidetclaspre)
    {
        request()->validate(Requidetclaspre::$rules);

        $requidetclaspre->update($request->all());

        return redirect()->route('requidetclaspres.index')
            ->with('success', 'Requidetclaspre updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $requidetclaspre = Requidetclaspre::find($id)->delete();

        return redirect()->route('requidetclaspres.index')
            ->with('success', 'Requidetclaspre deleted successfully');
    }
}
