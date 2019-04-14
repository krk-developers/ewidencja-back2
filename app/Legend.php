<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Legend extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description',];

    /**
     * Get the events for the legend.
     * 
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany('App\Event');
    }

    /**
     * All event's legend
     *
     * @return Collection
     */
    public static function all_(): Collection
    {
        return self::all();
    }
}
