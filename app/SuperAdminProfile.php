<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdminProfile extends Model
{
    /**
     * Get the profile's user.
     */
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
