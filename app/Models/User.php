<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;
    use HybridRelations;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The database type
     */
    protected $connection = 'mongodb';
    /**
     * The database collection name
     */
    protected $collection = 'users';

    /**
     * @var string
     */
    // protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return mixed
     */
    public function name() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isSiteManager() {
        return site()->managers()->where( 'user_id', $this->id )->first();
    }

    public function initials() {
        return mb_substr( $this->first_name, 0, 1 ) . mb_substr( $this->last_name, 0, 1 );
    }

    /**
     * @return mixed
     */
    public function customers() {
        return $this->hasMany( 'App\\Customer' );
    }

    /**
     * @return mixed
     */
    public function managers() {
        return $this->hasMany( 'App\\Manager' );
    }

    /**
     * @return mixed
     */
    public function isAppAdmin() {
        return $this->is_appadmin;
    }

    /**
     * @return mixed
     */
    public function messages() {
        return $this->hasMany( 'App\\Message' );
    }

}
