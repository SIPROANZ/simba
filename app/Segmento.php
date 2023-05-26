<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Segmento
 *
 * @property $id
 * @property $codigo
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Familia[] $familias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Segmento extends Model
{
    
    static $rules = [
		'codigo' => 'required',
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familias()
    {
        return $this->hasMany('App\Familia', 'segmento_id', 'id');
    }

    public function scopeDescripcion($query, $descripcion) {
    	if ($descripcion) {
    		return $query->where('nombre','like',"%$descripcion%");
    	}
    }


    public function scopeFechaInicio($query, $inicio) {
    	if ($inicio) {
    		return $query->where('created_at','>=',"$inicio");
    	}
    }

    public function scopeFechaFin($query, $fin) {
    	if ($fin) {
    		return $query->where('created_at','<=',"$fin");
    	}
    }
    

}
