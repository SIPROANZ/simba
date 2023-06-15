<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $nombre
 * @property $cedula
 * @property $genero
 * @property $telefono
 * @property $tipo
 * @property $unidad_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Unidade $unidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'cedula' => 'required',
		'genero' => 'required',
		'telefono' => 'required',
		'tipo' => 'required',
		'unidad_id' => 'required',
    'created_at' => 'required',
    'imagen' => 'required',
    'imagencedula' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','cedula','genero','telefono','tipo','unidad_id', 'created_at', 'usuario_id', 'imagen', 'imagencedula'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidade()
    {
        return $this->hasOne('App\Unidade', 'id', 'unidad_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
    

}
