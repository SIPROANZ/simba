<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Familia
 *
 * @property $id
 * @property $codigofamilia
 * @property $nombre
 * @property $segmento_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Clase[] $clases
 * @property Segmento $segmento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Familia extends Model
{
    
    static $rules = [
		'codigofamilia' => 'required',
		'nombre' => 'required',
		'segmento_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigofamilia','nombre','segmento_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clases()
    {
        return $this->hasMany('App\Clase', 'familia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function segmento()
    {
        return $this->hasOne('App\Segmento', 'id', 'segmento_id');
    }

    public function scopeDescripcion($query, $descripcion) {
    	if ($descripcion) {
    		return $query->where('nombre','like',"%$descripcion%");
    	}
    }

    public function scopeSegmentos($query, $segmento) {
    	if ($segmento) {
    		return $query->where('segmento_id','like',"$segmento");
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
