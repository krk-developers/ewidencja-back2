<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Worker extends Model
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
     * The employers that belong to the worker.
     */
    public function employers()
    {
        return $this->belongsToMany('App\Employer');
    }

    /**
     * Create profile
     *
     * @return Worker
     */
    public static function create_(): Worker
    {
        return self::create();
    }
}
