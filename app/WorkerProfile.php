<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class WorkerProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
    ];

    /**
     * Get the profile's user.
     * 
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne('App\User', 'userable');
    }

    /**
     * Create profile
     *
     * @return WorkerProfile
     */
    public static function create_(): WorkerProfile
    {
        return self::create();
    }
}
