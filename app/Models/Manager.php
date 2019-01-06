<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Manager extends Model {
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
    protected $collection = 'managers';
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

    /**
     * @return mixed
     */
    public function user() {
        return $this->belongsTo( 'App\User' );
    }

}
