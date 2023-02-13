<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivosestrategico
 *
 * @property $id
 * @property $objetivoestrategico
 * @property $objetivo
 * @property $nacional_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivogenerale[] $objetivogenerales
 * @property Objetivonacionale $objetivonacionale
 * @property Poa[] $poas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivosestrategico extends Model
{
    
    static $rules = [
		'objetivoestrategico' => 'required',
		'objetivo' => 'required',
		'nacional_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivoestrategico','objetivo','nacional_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivogenerales()
    {
        return $this->hasMany('App\Objetivogenerale', 'estrategico_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivonacionale()
    {
        return $this->hasOne('App\Objetivonacionale', 'id', 'nacional_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'estrategico_id', 'id');
    }
    

}
