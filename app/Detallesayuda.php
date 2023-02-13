<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesayuda
 *
 * @property $id
 * @property $montocompromiso
 * @property $ayuda_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Ayudassociale $ayudassociale
 * @property Ejecucione $ejecucione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesayuda extends Model
{
    
    static $rules = [
		'montocompromiso' => 'required',
		'ayuda_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['montocompromiso','ayuda_id','unidadadministrativa_id','ejecucion_id', 'financiamiento'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ayudassociale()
    {
        return $this->hasOne('App\Ayudassociale', 'id', 'ayuda_id');
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
