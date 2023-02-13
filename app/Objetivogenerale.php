<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivogenerale
 *
 * @property $id
 * @property $objetivogeneral
 * @property $objetivo
 * @property $estrategico_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivosestrategico $objetivosestrategico
 * @property Poa[] $poas
 * @property Poa[] $poas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivogenerale extends Model
{
    
    static $rules = [
		'objetivogeneral' => 'required',
		'objetivo' => 'required',
		'estrategico_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivogeneral','objetivo','estrategico_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivosestrategico()
    {
        return $this->hasOne('App\Objetivosestrategico', 'id', 'estrategico_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'nacional_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */   

}
