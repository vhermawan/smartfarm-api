<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_ref_sensors
 * @property string $name
 * @property string $unit
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Device[] $devices
 */
class RefSensors extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_ref_sensors';

    /**
     * @var array
     */
    protected $fillable = ['name', 'unit', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany('App\Models\Device', 'id_ref_sensors', 'id_ref_sensors');
    }
}
