<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuentasbancaria
 *
 * @property $id
 * @property $banco_id
 * @property $institucion_id
 * @property $fechaapertura
 * @property $montoapertura
 * @property $montosaldo
 * @property $cuenta
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @property Institucione $institucione
 * @property Movimientosbancario[] $movimientosbancarios
 * @property Transferencia[] $transferencias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cuentasbancaria extends Model
{
    
    static $rules = [
		'banco_id' => 'required',
		'institucion_id' => 'required',
		'fechaapertura' => 'required',
		'montoapertura' => 'required',
		'montosaldo' => 'required',
		'cuenta' => 'required',
		'descripcion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['banco_id','institucion_id','fechaapertura','montoapertura','montosaldo','cuenta','descripcion'];


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
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientosbancarios()
    {
        return $this->hasMany('App\Movimientosbancario', 'cuentasbancaria_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferencias()
    {
        return $this->hasMany('App\Transferencia', 'cuentasbancaria_id', 'id');
    }
    

}
