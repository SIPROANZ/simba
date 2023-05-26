<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidadmedida
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Bo[] $bos
 * @property Requidetbo[] $requidetbos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Unidadmedida extends Model
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
    protected $fillable = ['nombre','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bos()
    {
        return $this->hasMany('App\Bo', 'unidadmedida_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'undmedida_id', 'id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }  

    public function scopeDescripcion($query, $descripcion) {
    	if ($descripcion) {
    		return $query->where('nombre','like',"%$descripcion%");
    	}
    }

    public function scopeClases($query, $clase) {
    	if ($clase) {
    		return $query->where('clase_id','like',"$clase");
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
