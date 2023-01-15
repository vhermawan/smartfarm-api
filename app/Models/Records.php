<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_records
 * @property integer $id_sensors
 * @property float $value
 * @property string $date
 * @property Sensor $sensor
 */
class Records extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_records';

    /**
     * @var array
     */
    protected $fillable = ['id_sensors', 'value', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sensor()
    {
        return $this->belongsTo('App\Models\Sensor', 'id_sensors', 'id_sensors');
    }
}
