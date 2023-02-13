<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallesanalisi
 *
 * @property $id
 * @property $proveedor_id
 * @property $analisis_id
 * @property $bos_id
 * @property $cantidad
 * @property $precio
 * @property $subtotal
 * @property $iva
 * @property $total
 * @property $created_at
 * @property $updated_at
 *
 * @property Analisi $analisi
 * @property Bo $bo
 * @property Proveedore $proveedore
 * @property Beneficiario $beneficiario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Detallesanalisi extends Model
{
    
    static $rules = [
		'proveedor_id' => 'required',
		'analisis_id' => 'required',
		'bos_id' => 'required',
		'cantidad' => 'required',
		'precio' => 'required',
		/*'subtotal' => 'required',
		'iva' => 'required',
		'total' => 'required',*/
        'aprobado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['proveedor_id', 'beneficiario_id','analisis_id','bos_id','cantidad','precio','subtotal','iva','total','aprobado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function analisi()
    {
        return $this->hasOne('App\Analisi', 'id', 'analisis_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bo()
    {
        return $this->hasOne('App\Bo', 'id', 'bos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedore()
    {
        return $this->hasOne('App\Proveedore', 'id', 'proveedor_id');
    }
    
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario()
    {
        return $this->hasOne('App\Beneficiario', 'id', 'beneficiario_id');
    }

}
