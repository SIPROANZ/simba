<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucione
 *
 * @property $id
 * @property $rif
 * @property $institucion
 * @property $direccion
 * @property $telefono
 * @property $email
 * @property $baselegal
 * @property $web
 * @property $codigopostal
 * @property $organigrama
 * @property $logoinstitucion
 * @property $vision
 * @property $mision
 * @property $razonsocial
 * @property $municipio_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecuciondetalle[] $ejecuciondetalles
 * @property Ejecucione[] $ejecuciones
 * @property Meta[] $metas
 * @property Municipio $municipio
 * @property Poa[] $poas
 * @property Requisicione[] $requisiciones
 * @property Unidadadministrativa[] $unidadadministrativas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Institucione extends Model
{

    static $rules = [
		'rif' => 'required',
		'institucion' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
		'email' => 'required',
		'baselegal' => 'required',
		'web' => 'required',
		'codigopostal' => 'required',
		'organigrama' => 'mimes:jpeg,jpg,png|max:10240',
		'logoinstitucion' => 'mimes:jpeg,jpg,png|max:10240',
		'vision' => 'required',
		'mision' => 'required',
		'razonsocial' => 'required',
		'municipio_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rif','institucion','direccion','telefono','email','baselegal','web','codigopostal','organigrama','logoinstitucion','vision','mision','razonsocial','municipio_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciondetalles()
    {
        return $this->hasMany('App\Ejecuciondetalle', 'institucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'institucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany('App\Meta', 'institucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne('App\Municipio', 'id', 'municipio_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'institucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requisiciones()
    {
        return $this->hasMany('App\Requisicione', 'institucion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unidadadministrativas()
    {
        return $this->hasMany('App\Unidadadministrativa', 'institucion_id', 'id');
    }


}
