<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 *
 * @property $id
 * @property $nombre
 * @property $codigoonapre
 * @property $created_at
 * @property $updated_at
 *
 * @property Municipio[] $municipios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estado extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'codigoonapre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','codigoonapre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany('App\Municipio', 'estado_id', 'id');
    }

    public function scopeEstados($query, $estado) {
    	if ($estado) {
    		return $query->where('nombre','like',"%$estado%");
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
