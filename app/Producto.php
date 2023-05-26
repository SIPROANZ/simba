<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $codigoproducto
 * @property $nombre
 * @property $clase_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Clase $clase
 * @property Productoscp[] $productoscps
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'codigoproducto' => 'required',
		'nombre' => 'required',
		'clase_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codigoproducto','nombre','clase_id','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clase()
    {
        return $this->hasOne('App\Clase', 'id', 'clase_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productoscps()
    {
        return $this->hasMany('App\Productoscp', 'producto_id', 'id');
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
