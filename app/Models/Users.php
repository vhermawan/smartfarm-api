<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_users
 * @property string $nama
 * @property string $username
 * @property string $password
 * @property string $alamat
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Cage[] $cages
 */
class Users extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_users';

    /**
     * @var array
     */
    protected $fillable = ['nama', 'username', 'password', 'alamat', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cages()
    {
        return $this->hasMany('App\Models\Cage', 'id_users', 'id_users');
    }
}
