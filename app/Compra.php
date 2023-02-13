<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compra
 *
 * @property $id
 * @property $analisis_id
 * @property $numordencompra
 * @property $status
 * @property $fechaanulacion
 * @property $montobase
 * @property $montoiva
 * @property $montototal
 * @property $created_at
 * @property $updated_at
 *
 * @property Analisi $analisi
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compra extends Model
{
    
    static $rules = [
		'analisis_id' => 'required',
		'numordencompra' => 'required',
		'status' => 'required',
		'montobase' => 'required',
		'montoiva' => 'required',
		'montototal' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['analisis_id','numordencompra','status','fechaanulacion','montobase','montoiva','montototal', 'created_at','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function analisi()
    {
        return $this->hasOne('App\Analisi', 'id', 'analisis_id');
    }
    
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
}
