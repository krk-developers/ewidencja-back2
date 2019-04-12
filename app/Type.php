<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    /**
     * Get the users for the type.
     * 
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany('App\User');
    }

    /**
     * Scope a query to only include registrable types.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query Query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegistrable($query)
    {
        return $query
            ->select(['model', 'display_name'])
            ->where('registrable', 1)
            ->orderBy('name', 'desc')->get();
    }

    /**
     * Get ID by userable_type name
     *
     * @param string $name Name of the model (userable_type)
     * 
     * @return integer
     */
    public static function findIDByModelName(string $name): int
    {
        return self::where('model', $name)->value('id');
    }
}
