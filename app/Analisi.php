<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Analisi
 *
 * @property $id
 * @property $unidadadministrativa_id
 * @property $requisicion_id
 * @property $criterio_id
 * @property $numeracion
 * @property $observacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Criterio $criterio
 * @property Requisicione $requisicione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Analisi extends Model
{

    static $rules = [
		'unidadadministrativa_id' => 'required',
		'requisicion_id' => 'required',
		'criterio_id' => 'required',
		'numeracion' => 'required',
		'observacion' => 'required',
        'estatus' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['unidadadministrativa_id','requisicion_id','criterio_id','numeracion','observacion', 'estatus', 'fechaanulacion', 'created_at','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function criterio()
    {
        return $this->hasOne('App\Criterio', 'id', 'criterio_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requisicione()
    {
        return $this->hasOne('App\Requisicione', 'id', 'requisicion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detallesanalisi()
    {
        return $this->hasMany('App\Detallesanalisi', 'id', 'detallesanalisi_id');
    }
}
