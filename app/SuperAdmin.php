<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    /**
     * Get the profile's user.
     */
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
