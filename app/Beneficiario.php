<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Beneficiario
 *
 * @property $id
 * @property $caracterbeneficiario
 * @property $documento
 * @property $rif
 * @property $tiporesidencia
 * @property $tipobeneficiario
 * @property $tipocontribuyente
 * @property $nombre
 * @property $direccion
 * @property $telefono
 * @property $correo
 * @property $banco
 * @property $numerocuenta
 * @property $documentorepresentante
 * @property $nombrerepresentante
 * @property $telefonorepresentante
 * @property $correorepresentante
 * @property $bancorepresentante
 * @property $numerocuentarepresentante
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Beneficiario extends Model
{
    
    static $rules = [
		'caracterbeneficiario' => 'required',
		'documento' => 'required',
		'rif' => 'required',
		'tiporesidencia' => 'required',
		'tipobeneficiario' => 'required',
		'tipocontribuyente' => 'required',
		'nombre' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
		'correo' => 'required',
		'banco' => 'required',
		'numerocuenta' => 'required',
		'documentorepresentante' => 'required',
		'nombrerepresentante' => 'required',
		'telefonorepresentante' => 'required',
		'correorepresentante' => 'required',
		'bancorepresentante' => 'required',
		'numerocuentarepresentante' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['caracterbeneficiario','documento','rif','tiporesidencia','tipobeneficiario','tipocontribuyente','nombre','direccion','telefono','correo','banco','numerocuenta','documentorepresentante','nombrerepresentante','telefonorepresentante','correorepresentante','bancorepresentante','numerocuentarepresentante','usuario_id'];


	public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }

	public function scopeDireccion($query, $direccion) {
    	if ($direccion) {
    		return $query->where('direccion','like',"%$direccion%");
    	}
    }

	public function scopePersona($query, $persona) {
    	if ($persona) {
    		return $query->where('caracterbeneficiario','like',"$persona");
    	}
    }
}
