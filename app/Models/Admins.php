<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_admins
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class Admins extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_admins';

    /**
     * @var array
     */
    protected $fillable = ['name', 'username', 'password', 'deleted_at', 'created_at', 'updated_at'];
}
