<?php

namespace App\Http\Controllers;

use App\Tipossgp;
use Illuminate\Http\Request;

/**
 * Class TipossgpController
 * @package App\Http\Controllers
 */
class TipossgpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tipossgps = Tipossgp::paginate();

        $tipossgps = Tipossgp::query()
        ->when(request('search'), function($query){
            return $query->where('denominacion', 'like', '%'.request('search').'%');
         })
        ->orderBy('id', 'ASC')
        ->paginate(25)
        ->withQueryString();

        return view('tipossgp.index', compact('tipossgps'))
            ->with('i', (request()->input('page', 1) - 1) * $tipossgps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipossgp = new Tipossgp();
        return view('tipossgp.create', compact('tipossgp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tipossgp::$rules);

        $tipossgp = Tipossgp::create($request->all());

        return redirect()->route('tipossgps.index')
            ->with('success', 'Tipos de SGP creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipossgp = Tipossgp::find($id);

        return view('tipossgp.show', compact('tipossgp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipossgp = Tipossgp::find($id);

        return view('tipossgp.edit', compact('tipossgp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tipossgp $tipossgp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipossgp $tipossgp)
    {
        request()->validate(Tipossgp::$rules);

        $tipossgp->update($request->all());

        return redirect()->route('tipossgps.index')
            ->with('success', 'Tipossgp updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipossgp = Tipossgp::find($id)->delete();

        return redirect()->route('tipossgps.index')
            ->with('success', 'Tipossgp deleted successfully');
    }
}
