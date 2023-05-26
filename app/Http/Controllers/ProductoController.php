<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Clase;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.bos')->only('index', 'edit', 'update', 'create', 'store');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $productos = Producto::paginate();
        $productos = Producto::query()
       ->when(request('search'), function($query){
           return $query->where ('codigoproducto', 'like', '%'.request('search').'%')
                        ->orWhere('nombre', 'like', '%'.request('search').'%')
                        ->orderBy('codigoproducto', 'ASC');
        },
        function ($query) {
            $query->orderBy('codigoproducto', 'ASC');
        })
       ->paginate(25)
       ->withQueryString();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();
        $clases = Clase::pluck('nombre', 'id');
        return view('producto.create', compact('producto','clases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Producto::$rules);

        //Agregar el id del usuario
        $id_usuario = $request->user()->id;
        $request->merge(['usuario_id'=>$id_usuario]);
        
        $producto = Producto::create($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $clases = Clase::pluck('nombre', 'id');
        return view('producto.edit', compact('producto','clases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        request()->validate(Producto::$rules);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }

    public function reportes()
    {
        $clases = Clase::orderBy('nombre', 'ASC')->pluck('nombre','id');
        $usuarios = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('producto.reportes', compact('clases', 'usuarios'));
    }

    public function reporte_pdf(Request $request)
    {
        //Buscar por institucion
        $descripcion = $request->descripcion;
        $clase = $request->clase;
        $usuario = $request->usuario;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        
        $nombre_clase = '';
        $rs_clase = Clase::find($clase);
        if($rs_clase){
            $nombre_clase = $rs_clase->nombre;
        }

        $nombre_usuario = '';
        $rs_usuario = User::find($usuario);
        if($rs_usuario){
            $nombre_usuario = $rs_usuario->name;
        }

        $productos = Producto::descripcion($descripcion)->clases($clase)->usuarios($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total = count($productos);
        
        $datos = [
            'clase' => $nombre_clase,
            'usuario' => $nombre_usuario,
            'total' => $total, 
            'inicio' => $inicio,
            'fin' => $fin,   
            'descripcion' =>$descripcion,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('producto.reportepdf', ['datos'=>$datos, 'productos'=>$productos]);
        return $pdf->stream();
         
    }

    
}
