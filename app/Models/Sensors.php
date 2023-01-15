<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_sensors
 * @property integer $id_cages
 * @property integer $id_devices
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Record[] $records
 * @property Device $device
 * @property Cage $cage
 */
class Sensors extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_sensors';

    /**
     * @var array
     */
    protected $fillable = ['id_cages', 'id_devices', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function records()
    {
        return $this->hasMany('App\Models\Record', 'id_sensors', 'id_sensors');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo('App\Models\Device', 'id_devices', 'id_devices');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cage()
    {
        return $this->belongsTo('App\Models\Cage', 'id_cages', 'id_cages');
    }
}
