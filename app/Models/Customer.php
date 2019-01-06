<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Customer extends Model {
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
    protected $collection = 'customers';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'default_attribute' => false,
    ];
    /**
     * @param User $user
     */
    public function assignUser( User $user ) {
        $this->user_id       = $user->id;
        $this->contact_name  = $user->first_name . ' ' . $user->last_name;
        $this->contact_email = $user->email;
    }

    /**
     * @return mixed
     */
    public function site() {
        return $this->belongsTo( 'App\Site' );
    }

}
