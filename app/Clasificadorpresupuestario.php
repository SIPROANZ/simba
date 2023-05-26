<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clasificadorpresupuestario
 *
 * @property $id
 * @property $cuenta
 * @property $denominacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Productoscp[] $productoscps
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clasificadorpresupuestario extends Model
{
    
    static $rules = [
		'cuenta' => 'required',
		'denominacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cuenta','denominacion','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productoscps()
    {
        return $this->hasMany('App\Productoscp', 'clasificadorp_id', 'id');
    }
  
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    } 
    
    public function scopeClasificador($query, $denominacion) {
    	if ($denominacion) {
    		return $query->where('denominacion','like',"%$denominacion%");
    	}
    }

    public function scopeUsuarios($query, $usuario) {
    	if ($usuario) {
    		return $query->where('usuario_id','like',"$usuario");
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
