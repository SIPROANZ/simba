<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimientosbancario
 *
 * @property $id
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $cuentasbancaria_id
 * @property $beneficiario_id
 * @property $tipomovimiento_id
 * @property $referencia
 * @property $descripcion
 * @property $fecha
 * @property $monto
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @property Tipomovimiento $tipomovimiento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movimientosbancario extends Model
{
    
    static $rules = [
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'cuentasbancaria_id' => 'required',
		'beneficiario_id' => 'required',
		'tipomovimiento_id' => 'required',
		'referencia' => 'required',
		'descripcion' => 'required',
		'fecha' => 'required',
		'monto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ejercicio_id','institucion_id','cuentasbancaria_id','beneficiario_id','tipomovimiento_id','referencia','descripcion','fecha','monto'];


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
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentasbancaria_id');
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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipomovimiento()
    {
        return $this->hasOne('App\Tipomovimiento', 'id', 'tipomovimiento_id');
    }
    

}
