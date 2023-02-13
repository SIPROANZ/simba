<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesajuste
 *
 * @property $id
 * @property $montoajuste
 * @property $ajustes_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ajustescompromiso $ajustescompromiso
 * @property Ejecucione $ejecucione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesajuste extends Model
{
    
    static $rules = [
		'montoajuste' => 'required',
		'ajustes_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['montoajuste','ajustes_id','unidadadministrativa_id','ejecucion_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ajustescompromiso()
    {
        return $this->hasOne('App\Ajustescompromiso', 'id', 'ajustes_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ejecucione()
    {
        return $this->hasOne('App\Ejecucione', 'id', 'ejecucion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
