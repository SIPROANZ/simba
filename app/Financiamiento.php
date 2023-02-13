<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Financiamiento
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecuciondetalle[] $ejecuciondetalles
 * @property Ejecucione[] $ejecuciones
 * @property Requidetbo[] $requidetbos
 * @property Requidetclaspre[] $requidetclaspres
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Financiamiento extends Model
{

    static $rules = [
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciondetalles()
    {
        return $this->hasMany('App\Ejecuciondetalle', 'financiamiento_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'financiamiento_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'financiamiento_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetclaspres()
    {
        return $this->hasMany('App\Requidetclaspre', 'financiamiento_id', 'id');
    }


}
