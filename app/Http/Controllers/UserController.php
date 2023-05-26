<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Unidadadministrativa;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

use PDF;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * Metodo Constuct
     */
public function __construct()
{
    $this->middleware('can:admin.administrador')->only('index', 'edit', 'update', 'create', 'store');
    
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $users = User::paginate();

        $users = User::query()
       ->when(request('search'), function($query){
           return $query->where ('name', 'like', '%'.request('search').'%')
                        ->orWhere('email', 'like', '%'.request('search').'%')
                        ->orWhereHas('unidadadministrativa', function($q){
                         $q->where('unidadejecutora', 'like', '%'.request('search').'%');
                         })->orderBy('name', 'ASC');
        },
        function ($query) {
            $query->orderBy('name', 'ASC');
        })
        
       ->paginate(25)
       ->withQueryString();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

       // $unidades = Unidadadministrativa::orderBy('unidadejecutora', 'ASC')->pluck('unidadejecutora','id');
        
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
                ->orderBy('name', 'ASC')
            ->pluck('name', 'id');
        
        return view('user.create', compact('user', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'unidad_id' => $request->unidad_id,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario Creado Satisfactoriamenete.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /* $user = User::find($id);

        return view('user.edit', compact('user'));*/
       
        $user = User::find($id);

        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // request()->validate(User::$rules);

        $user->update($request->all());

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'Usuario Editado satisfactoriamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function reportes()
    {
        $unidades = Unidadadministrativa::select(
            DB::raw("CONCAT(sector,'.',programa,'.',subprograma,'.',proyecto,'.',actividad,' ',unidadejecutora) AS name"),'id')
            ->orderBy('name','ASC')
            ->pluck('name', 'id'); 
        return view('user.reportes', compact('unidades'));   
    }

    public function reporte_pdf(Request $request)
    {
        $usuario = $request->usuario;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;
        $unidad = $request->unidad;

        $nombre_unidad = '';
        $rs_unidad = Unidadadministrativa::find($unidad);
        if($rs_unidad){
            $nombre_unidad = $rs_unidad->sector .'-'.
            $rs_unidad->programa .'-'.
            $rs_unidad->subprograma .'-'.
            $rs_unidad->proyecto .'-'.
            $rs_unidad->actividad .' '.
            $rs_unidad->unidadejecutora;
        }
        
        //
        $users = User::unidad($unidad)->usuario($usuario)->fechaInicio($inicio)->fechaFin($fin)->get();
        $total_objetivo = count($users);
       
        $datos = [
            'total_objetivo' => $total_objetivo,
            'usuario' => $usuario,
            'unidad' => $nombre_unidad,
            'inicio' => $inicio,
            'fin' => $fin,  
            ]; 

        $pdf = PDF::setPaper('letter', 'portrait')->loadView('user.reportepdf', ['datos'=>$datos, 'users'=>$users]);
        return $pdf->stream();
    }
}
