<?php

namespace App\Http\Controllers;

use App\Productoscp;
use App\Producto;
use App\Clasificadorpresupuestario;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PDF;

/**
 * Class ProductoscpController
 * @package App\Http\Controllers
 */
class ProductoscpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $productoscps = Productoscp::paginate();

       $productoscps = Productoscp::query()
       ->when(request('search'), function($query){
           return $query->where ('id', 'like', '%'.request('search').'%')
                        ->orWhereHas('clasificadorpresupuestario', function($q){
                         $q->where('denominacion', 'like', '%'.request('search').'%')
                         ->orWhere('cuenta', 'like', '%'.request('search').'%');
                         })
                          ->orWhereHas('producto', function($qa){
                            $qa->where('codigoproducto', 'like', '%'.request('search').'%')
                                ->orWhere('nombre', 'like', '%'.request('search').'%');
                        });
        },
        function ($query) {
            $query->orderBy('id', 'ASC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('productoscp.index', compact('productoscps'))
            ->with('i', (request()->input('page', 1) - 1) * $productoscps->perPage());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productoscp = new Productoscp();

        $productos = Producto::orderBy('nombre','ASC')->pluck('nombre', 'id');
        $clasificadorpresupuestarios = Clasificadorpresupuestario::select(
            DB::raw("CONCAT(cuenta,' - ',denominacion) AS name"),'id')
            ->pluck('name', 'id');
        
        //Clasificadorpresupuestario::orderBy('denominacion','ASC')->pluck('denominacion', 'id'); 
      
      return view('productoscp.create', compact('productoscp' , 'productos',  'clasificadorpresupuestarios'));

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Productoscp::$rules);

        $productoscp = Productoscp::create($request->all());

        return redirect()->route('productoscps.index')
            ->with('success', 'Productos clasificador presupuestario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productoscp = Productoscp::find($id);

        return view('productoscp.show', compact('productoscp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productoscp = Productoscp::find($id);

        $productos = Producto::pluck('nombre', 'id');
        $clasificadorpresupuestarios = Clasificadorpresupuestario::pluck('denominacion', 'id');        

        return view('productoscp.edit', compact('productoscp' , 'productos', 'clasificadorpresupuestarios'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Productoscp $productoscp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productoscp $productoscp)
    {
        request()->validate(Productoscp::$rules);

        $productoscp->update($request->all());

        return redirect()->route('productoscps.index')
            ->with('success', 'Productos clasificador presupuestario actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productoscp = Productoscp::find($id)->delete();

        return redirect()->route('productoscps.index')
            ->with('success', 'Productos clasificador presupuestario eliminado exitosamente.');
    }
}
