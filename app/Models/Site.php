<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Site extends Model {

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
    protected $collection = 'sites';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'default_attribute' => false,
    ];

    /**
     * Get shop customers
     */
    public function customers() {
        return $this->hasMany( 'App\Customer' );
    }

    /**
     * Get shop managers
     */
    public function managers() {
        return $this->hasMany( 'App\Manager' );
    }

    /**
     * Get shop owners
     */
    public function owners() {
        return $this->hasMany( 'App\Manager' )->where( 'is_owner', '=', '1' );
    }

}
