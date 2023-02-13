<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comprascp
 *
 * @property $id
 * @property $compra_id
 * @property $unidadadministrativa_id
 * @property $ejecucion_id
 * @property $monto
 * @property $disponible
 * @property $created_at
 * @property $updated_at
 *
 * @property Compra $compra
 * @property Ejecucione $ejecucione
 * @property Unidadadministrativa $unidadadministrativa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comprascp extends Model
{
    
    static $rules = [
		'compra_id' => 'required',
		'unidadadministrativa_id' => 'required',
		'ejecucion_id' => 'required',
		'monto' => 'required',
		'disponible' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['compra_id','unidadadministrativa_id','ejecucion_id','monto','disponible', 'financiamiento'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function compra()
    {
        return $this->hasOne('App\Compra', 'id', 'compra_id');
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
