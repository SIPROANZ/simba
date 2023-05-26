<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Objetivonacionale
 *
 * @property $id
 * @property $objetivonacional
 * @property $objetivo
 * @property $historico_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Objetivosestrategico[] $objetivosestrategicos
 * @property Objetivoshistorico $objetivoshistorico
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Objetivonacionale extends Model
{
    
    static $rules = [
		'objetivonacional' => 'required',
		'objetivo' => 'required',
		'historico_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['objetivonacional','objetivo','historico_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivosestrategicos()
    {
        return $this->hasMany('App\Objetivosestrategico', 'nacional_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetivoshistorico()
    {
        return $this->hasOne('App\Objetivoshistorico', 'id', 'historico_id');
    }

    public function scopeObjetivos($query, $objetivo) {
    	if ($objetivo) {
    		return $query->where('objetivo','like',"%$objetivo%");
    	}
    }

    public function scopeHistoricos($query, $historico) {
    	if ($historico) {
    		return $query->where('historico_id','like',"$historico");
    	}
    }

    public function scopeFechaInicio($query, $inicio) {
    	if ($inicio) {
    		return $query->where('created_at','>=',"$inicio");
    	}
    }

    public function scopeFechaFin($query, $fin) {
    	if ($fin) {
    		return $query->where('created_at','<=',"$fin");
    	}
    }
    

}
