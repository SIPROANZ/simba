<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuracione
 *
 * @property $id
 * @property $nombre
 * @property $valor
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Configuracione extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','valor','descripcion'];



}
