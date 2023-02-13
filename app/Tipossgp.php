<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipossgp
 *
 * @property $id
 * @property $denominacion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tipossgp extends Model
{
    
    static $rules = [
		'denominacion' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['denominacion'];



}
