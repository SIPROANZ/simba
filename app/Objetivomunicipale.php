<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivomunicipale
 *
 * @property $id
 * @property $objetivomunicipal
 * @property $objetivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivopei[] $objetivopeis
 * @property Poa[] $poas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivomunicipale extends Model
{
    
    static $rules = [
		'objetivomunicipal' => 'required',
		'objetivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivomunicipal','objetivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivopeis()
    {
        return $this->hasMany('App\Objetivopei', 'municipal_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poas()
    {
        return $this->hasMany('App\Poa', 'municipal_id', 'id');
    }
    

}
