<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clase
 *
 * @property $id
 * @property $codigoclase
 * @property $nombre
 * @property $familia_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Familia $familia
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clase extends Model
{
    
    static $rules = [
		'codigoclase' => 'required',
		'nombre' => 'required',
		'familia_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigoclase','nombre','familia_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function familia()
    {
        return $this->hasOne('App\Familia', 'id', 'familia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Producto', 'clase_id', 'id');
    }

    public function scopeDescripcion($query, $descripcion) {
    	if ($descripcion) {
    		return $query->where('nombre','like',"%$descripcion%");
    	}
    }

    public function scopeFamilias($query, $familia) {
    	if ($familia) {
    		return $query->where('familia_id','like',"$familia");
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
