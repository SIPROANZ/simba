<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesmodificacione
 *
 * @property $id
 * @property $modificacion_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $montoacredita
 * @property $montodebita
 * @property $created_at
 * @property $updated_at
 *
 * @property Ejecucione $ejecucione
 * @property Modificacione $modificacione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesmodificacione extends Model
{
    
    static $rules = [
		'modificacion_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['modificacion_id','unidadadministrativa_id','ejecucion_id','montoacredita','montodebita','financiamiento'];


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
    public function modificacione()
    {
        return $this->hasOne('App\Modificacione', 'id', 'modificacion_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unidadadministrativa()
    {
        return $this->hasOne('App\Unidadadministrativa', 'id', 'unidadadministrativa_id');
    }
    

}
