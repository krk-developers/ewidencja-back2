<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company',
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
     * The workers that belong to the employer.
     */
    public function workers()
    {
        return $this->belongsToMany('App\Worker');
    }

    /**
     * Create profile
     *
     * @return Employer
     */
    public static function create_(): Employer
    {
        return self::create();
    }
}
