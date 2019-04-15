<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
    public function employers(): BelongsToMany
    {
        return $this->belongsToMany('App\Employer');
    }

    /**
     * Get the events for the user.
     * 
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany('App\Event');
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

    /**
     * All events assigned to workers.
     *
     * @return void
     */
    public static function all_(): Collection
    {
        return DB::table('workers')
            ->select(
                'workers.id', 'users.name as firstname',
                'workers.lastname', 'users.email',
                'types.display_name as type_display_name'
            )
            ->join('users', 'workers.id', '=', 'users.userable_id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->where('types.name', 'worker')
            ->get();        
    }
}
