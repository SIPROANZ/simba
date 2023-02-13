<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ejercicio
 *
 * @property $id
 * @property $nombreejercicio
 * @property $ejercicioorigen
 * @property $ejercicioejecucion
 * @property $estatus
 * @property $observacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione[] $ejecuciones
 * @property Meta[] $metas
 * @property Poa[] $poas
 * @property Requisicione[] $requisiciones
 * @property Unidadadministrativa[] $unidadadministrativas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ejercicio extends Model
{
    
    static $rules = [
		'nombreejercicio' => 'required',
		'ejercicioorigen' => 'required',
		'ejercicioejecucion' => 'required',
		'estatus' => 'required',
		'observacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombreejercicio','ejercicioorigen','ejercicioejecucion','estatus','observacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ejecuciones()
    {
        return $this->hasMany('App\Ejecucione', 'ejercicio_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metas()
    {
        return $this->hasMany('App\Meta', 'ejercicio_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'ejercicio_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requisiciones()
    {
        return $this->hasMany('App\Requisicione', 'ejercicio_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unidadadministrativas()
    {
        return $this->hasMany('App\Unidadadministrativa', 'ejercicio_id', 'id');
    }
    

}
