<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\EnumTrait;

/**
 * Class Retencione
 *
 * @property $id
 * @property $descripcion
 * @property $porcentaje
 * @property $tipo
 * @property $tiporetencion
 * @property $created_at
 * @property $updated_at
 *
 * @property Detalleretencione[] $detalleretenciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Retencione extends Model
{
    //use EnumTrait;
    static $rules = [
		'descripcion' => 'required',
		'porcentaje' => 'required',
		'tipo' => 'required',
		'tiporetencion_id' => 'required',
		'base_calculo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descripcion','porcentaje','tipo','tiporetencion_id','base_calculo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalleretenciones()
    {
        return $this->hasMany('App\Detalleretencione', 'retencion_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tiporetencione()
    {
        //return $this->hasOne(Tiporetencione::class);
        return $this->hasOne('App\Tiporetencione', 'id', 'tiporetencion_id');
    }

/*     protected static $enums = [
        'TIPO' => 'tipo'
    ]; */
    /**
    * Users' estatus
    *
    * @var array
    */
/*     public const TIPO = [
        'I' => 'Impuesto',
        'R' => 'Retención'
    ]; */

}
