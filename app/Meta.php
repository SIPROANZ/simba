<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Meta
 *
 * @property $id
 * @property $poa_id
 * @property $cantidad1
 * @property $cantidad2
 * @property $cantidad3
 * @property $cantidad4
 * @property $meta
 * @property $monto
 * @property $ejercicio_id
 * @property $institucion_id
 * @property $unidadadministrativa_id
 * @property $tipo
 * @property $enero
 * @property $febrero
 * @property $marzo
 * @property $abril
 * @property $mayo
 * @property $junio
 * @property $julio
 * @property $agosto
 * @property $septiembre
 * @property $octubre
 * @property $noviembre
 * @property $diciembre
 * @property $unidadmedida
 * @property $unidadadministrativasolicitante
 * @property $impacto
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione[] $ejecuciones
 * @property Ejercicio $ejercicio
 * @property Institucione $institucione
 * @property Poa $poa
 * @property Requidetbo[] $requidetbos
 * @property Requidetclaspre[] $requidetclaspres
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Meta extends Model
{
    
    static $rules = [
		'poa_id' => 'required',
		'cantidad1' => 'required',
		'cantidad2' => 'required',
		'cantidad3' => 'required',
		'cantidad4' => 'required',
		'meta' => 'required',
		'monto' => 'required',
		'ejercicio_id' => 'required',
		'institucion_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'tipo' => 'required',
		'enero' => 'required',
		'febrero' => 'required',
		'marzo' => 'required',
		'abril' => 'required',
		'mayo' => 'required',
		'junio' => 'required',
		'julio' => 'required',
		'agosto' => 'required',
		'septiembre' => 'required',
		'octubre' => 'required',
		'noviembre' => 'required',
		'diciembre' => 'required',
		'unidadmedida' => 'required',
		'unidadadministrativasolicitante' => 'required',
		'impacto' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['poa_id','cantidad1','cantidad2','cantidad3','cantidad4','meta','monto','ejercicio_id','institucion_id','unidadadministrativa_id','tipo','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre','unidadmedida','unidadadministrativasolicitante','impacto','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'meta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejercicio()
    {
        return $this->hasOne('App\Ejercicio', 'id', 'ejercicio_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institucione()
    {
        return $this->hasOne('App\Institucione', 'id', 'institucion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function poa()
    {
        return $this->hasOne('App\Poa', 'id', 'poa_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetbos()
    {
        return $this->hasMany('App\Requidetbo', 'meta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requidetclaspres()
    {
        return $this->hasMany('App\Requidetclaspre', 'meta_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }   

}
