<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $nombre
 * @property $cedula
 * @property $genero
 * @property $telefono
 * @property $tipo
 * @property $unidad_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Unidade $unidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'cedula' => 'required',
		'genero' => 'required',
		'telefono' => 'required',
		'tipo' => 'required',
		'unidad_id' => 'required',
    'created_at' => 'required',
    'imagen' => 'required',
    'imagencedula' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','cedula','genero','telefono','tipo','unidad_id', 'created_at', 'usuario_id', 'imagen', 'imagencedula'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidade()
    {
        return $this->hasOne('App\Unidade', 'id', 'unidad_id');
    }

    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

    public function scopeNombre($query, $nombre) {
    	if ($nombre) {
    		return $query->where('nombre','like',"%$nombre%");
    	}
    }

    public function scopeGenero($query, $genero) {
    	if ($genero) {
    		return $query->where('genero','like',"$genero");
    	}
    }

    public function scopeTipo($query, $tipo) {
    	if ($tipo) {
    		return $query->where('tipo','like',"$tipo");
    	}
    }

    public function scopeUnidades($query, $unidad_id) {
    	if ($unidad_id) {
    		return $query->where('unidad_id','like',"$unidad_id");
    	}
    }

    public function scopeGabinetes($query, $gabinete_id) {
    	if ($gabinete_id) {

            return $query->whereHas('unidade', function($qa) use ($gabinete_id) {
                $qa->whereHas('gabinete', function($q) use ($gabinete_id) {
                    $q->where('id', 'like', "$gabinete_id");
                });
            });

            /*
    		return $query->where('gabinete_id','like',"$gabinete_id");
            */
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
