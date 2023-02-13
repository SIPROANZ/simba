<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transferencia
 *
 * @property $id
 * @property $banco_id
 * @property $cuentasbancaria_id
 * @property $beneficiario_id
 * @property $pagado_id
 * @property $montotransferencia
 * @property $fechaanulacion
 * @property $concepto
 * @property $egreso
 * @property $status
 * @property $montoorden
 * @property $referenciabancaria
 * @property $conceptoanulacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Beneficiario $beneficiario
 * @property Cuentasbancaria $cuentasbancaria
 * @property Pagado $pagado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Transferencia extends Model
{
    
    static $rules = [        
		'cuentasbancaria_id' => 'required',
		'beneficiario_id' => 'required',
		'pagado_id' => 'required',
		'montotransferencia' => 'required',
		'concepto' => 'required',
		'egreso' => 'required',
		'montoorden' => 'required',
		'referenciabancaria' => 'required',		
      
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cuentasbancaria_id','beneficiario_id','pagado_id','montotransferencia','concepto','egreso','montoorden','referenciabancaria','conceptoanulacion', 'created_at','usuario_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuentasbancaria()
    {
        return $this->hasOne('App\Cuentasbancaria', 'id', 'cuentasbancaria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pagado()
    {
        return $this->hasOne('App\Pagado', 'id', 'pagado_id');
    }
    public function usuario()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }  

}
