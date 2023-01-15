<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_devices
 * @property integer $id_ref_sensors
 * @property string $key
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property RefSensor $refSensor
 * @property Sensor $sensor
 */
class Devices extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_devices';

    /**
     * @var array
     */
    protected $fillable = ['id_ref_sensors', 'key', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refSensor()
    {
        return $this->belongsTo('App\Models\RefSensor', 'id_ref_sensors', 'id_ref_sensors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sensor()
    {
        return $this->hasOne('App\Models\Sensor', 'id_devices', 'id_devices');
    }
}
