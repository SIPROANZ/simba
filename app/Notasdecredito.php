<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notasdecredito
 *
 * @property $id
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $beneficiario_id
 * @property $banco_id
 * @property $cuentabancaria_id
 * @property $fecha
 * @property $referencia
 * @property $descripcion
 * @property $monto
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notasdecredito extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'beneficiario_id' => 'required',
		'banco_id' => 'required',
		'cuentabancaria_id' => 'required',
		'referencia' => 'required',
		'descripcion' => 'required',
		'monto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','institucion_id','beneficiario_id','banco_id','cuentabancaria_id','fecha','referencia','descripcion','monto', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function banco()
    {
        return $this->hasOne('App\Banco', 'id', 'banco_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentabancaria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    } 

}
