<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hijo
 *
 * @property $id
 * @property $nombre
 * @property $cedula
 * @property $genero
 * @property $anexocedula
 * @property $anexopartida
 * @property $cedularepresentante
 * @property $observacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Hijo extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'cedula' => 'required',
		'genero' => 'required',
		'anexocedula' => 'required',
		'anexopartida' => 'required',
		'cedularepresentante' => 'required',
		'observacion' => 'required',
    'imagen' => 'required',
    'created_at' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','cedula','genero','anexocedula','anexopartida','cedularepresentante','observacion','created_at', 'usuario_id', 'hijo'];


    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

}
