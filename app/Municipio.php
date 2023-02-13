<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 *
 * @property $id
 * @property $nombre
 * @property $codigo
 * @property $estado_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Estado $estado
 * @property Institucione[] $instituciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'codigo' => 'required',
		'estado_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','codigo','estado_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estado()
    {
        return $this->hasOne('App\Estado', 'id', 'estado_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instituciones()
    {
        return $this->hasMany('App\Institucione', 'municipio_id', 'id');
    }
    

}
