<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Modificacione
 *
 * @property $id
 * @property $numero
 * @property $tipomodificacion_id
 * @property $descripcion
 * @property $status
 * @property $fechaanulacion
 * @property $montocredita
 * @property $montodebita
 * @property $ncredito
 * @property $created_at
 * @property $updated_at
 *
 * @property Detallesmodificacione[] $detallesmodificaciones
 * @property Tipomodificacione $tipomodificacione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Modificacione extends Model
{
    
    static $rules = [
		
		'tipomodificacion_id' => 'required',
		'descripcion' => 'required',
		'status' => 'required',
		'ncredito' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numero','tipomodificacion_id','descripcion','status','fechaanulacion','montocredita','montodebita','ncredito', 'usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesmodificaciones()
    {
        return $this->hasMany('App\Detallesmodificacione', 'modificacion_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipomodificacione()
    {
        return $this->hasOne('App\Tipomodificacione', 'id', 'tipomodificacion_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }   

}
