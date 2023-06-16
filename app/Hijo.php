<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hijo
 *
 * @property $id
 * @property $nombre
 * @property $cedula
 * @property $genero
 * @property $anexocedula
 * @property $anexopartida
 * @property $cedularepresentante
 * @property $observacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Hijo extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'cedula' => 'required',
		'genero' => 'required',
		'anexocedula' => 'required',
		'anexopartida' => 'required',
		'cedularepresentante' => 'required',
		'observacion' => 'required',
    'imagen' => 'required',
    'created_at' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','cedula','genero','anexocedula','anexopartida','cedularepresentante','observacion','created_at', 'usuario_id', 'hijo', 'imagen'];


    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

    public function representante()
    {
        return $this->hasOne('App\Empleado', 'cedula', 'cedularepresentante');
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

    public function scopeCedulas($query, $cedula) {
    	if ($cedula) {

            return $query->whereHas('representante', function($qa) use ($cedula) {
                $qa->where('cedula', 'like', "$cedula");
            });
            /*
    		return $query->where('tipo','like',"$tipo");*/
    	}
    }

    public function scopeNombre_representante($query, $nombre) {
    	if ($nombre) {

            return $query->whereHas('representante', function($qa) use ($nombre) {
                $qa->where('nombre', 'like', "%$nombre%");
            });
            /*
    		return $query->where('tipo','like',"$tipo");*/
    	}
    }

    public function scopeUnidades($query, $unidad_id) {
    	if ($unidad_id) {

            return $query->whereHas('representante', function($qa) use ($unidad_id) {
                $qa->where('unidad_id', 'like', "$unidad_id");
            });
            /*
    		return $query->where('unidad_id','like',"$unidad_id");*/
    	}
    }

    public function scopeGabinetes($query, $gabinete_id) {
    	if ($gabinete_id) {

            return $query->whereHas('representante', function($qat) use ($gabinete_id) {
             $qat->whereHas('unidade', function($qa) use ($gabinete_id) {
                $qa->whereHas('gabinete', function($q) use ($gabinete_id) {
                    $q->where('id', 'like', "$gabinete_id");
                });
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
